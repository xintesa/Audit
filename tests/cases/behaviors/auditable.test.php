<?php

App::import( 'Core', array( 'AppModel', 'Model' ) );

/**
 * Article class
 *
 * @package       cake
 * @subpackage    cake.tests.cases.libs.model
 */
class Article extends CakeTestModel {
  /**
   * name property
   *
   * @var string 'Article'
   * @access public
   */
  public $name = 'Article';
  public $actsAs = array(
    'AuditLog.Auditable'
  );
}

/**
 * AuditableBehavior test class.
 */
class AuditableBehaviorTest extends CakeTestCase {
  /**
   * Fixtures associated with this test case
   *
   * @var array
   * @access public
   */
	public $fixtures = array(
		'core.article',
    'plugin.audit_log.audit',
    'plugin.audit_log.audit_delta',
	);
  
  /**
   * Method executed before each test
   *
   * @access public
   */
	public function startTest() {
		$this->Article = ClassRegistry::init( 'Article' );
	}
  
  /**
   * Method executed after each test
   *
   * @access public
   */
	public function endTest() {
		unset( $this->Article );

		ClassRegistry::flush();
	}
  
  /**
   * Test the action of creating a new record.
   *
   * @todo  Test HABTM save
   */
  public function testCreate() {
    $new_article = array(
      'Article' => array(
        'user_id' => 1,
        'title' => 'First Test Article', 
        'body' => 'First Test Article Body', 
        'published' => 'N', 
      ),
    );
    
    $this->Article->save( $new_article );
    $audit = ClassRegistry::init( 'Audit' )->find(
      'first',
      array(
        'recursive'  => -1,
        'conditions' => array(
          'Audit.event' => 'CREATE',
          'Audit.model' => 'Article',
          'Audit.entity_id' => $this->Article->getLastInsertId()
        )
      )
    );
    $article = json_decode( $audit['Audit']['json_object'], true );
    
    $deltas = ClassRegistry::init( 'AuditDelta' )->find(
      'all',
      array(
        'recursive' => -1,
        'conditions' => array( 'AuditDelta.audit_id' => $audit['Audit']['id'] ),
      )
    );
    
    # Verify the audit record
    $this->assertEqual( 1, $article['Article']['user_id'] );
    $this->assertEqual( 'First Test Article', $article['Article']['title'] );
    $this->assertEqual( 'N', $article['Article']['published'] );
    
    #Verify that no delta record was created.
    $this->assertTrue( empty( $deltas ) );
  }
  
  /**
   * Test editing an existing record.
   *
   * @todo  Test change to ignored field
   * @todo  Test HABTM save
   */
  public function testEdit() {
    $this->Audit      = ClassRegistry::init( 'Audit' );
    $this->AuditDelta = ClassRegistry::init( 'AuditDelta' );
    
    $new_article = array(
      'Article' => array(
        'user_id' => 1,
        'title' => 'First Test Article', 
        'body' => 'First Test Article Body', 
        'published' => 'N', 
      ),
    );
    
    # TEST SAVE WITH SINGLE PROPERTY UPDATE
    
    $this->Article->save( $new_article );
    $this->Article->saveField( 'title', 'First Test Article (Edited)' );
    
    $audit_records = $this->Audit->find(
      'all',
      array(
        'conditions' => array(
          'Audit.model' => 'Article',
          'Audit.entity_id' => $this->Article->getLastInsertId()
        )
      )
    );
    $delta_records = $this->AuditDelta->find(
      'all',
      array(
        'recursive' => -1,
        'conditions' => array( 'AuditDelta.audit_id' => Set::extract( '/Audit/id', $audit_records ) ),
      )
    );
    
    $create_audit = Set::extract( '/Audit[event=CREATE]', $audit_records );
    $update_audit = Set::extract( '/Audit[event=EDIT]', $audit_records );
    
    # There should be 1 CREATE and 1 EDIT record
    $this->assertEqual( 2, count( $audit_records ) );
    
    # There should be one audit record for each event.
    $this->assertEqual( 1, count( $create_audit ) );
    $this->assertEqual( 1, count( $update_audit ) );
    
    # Only one property was changed
    $this->assertEqual( 1, count( $delta_records ) );
    
    $delta = array_shift( $delta_records );
    $this->assertEqual( 'First Test Article', $delta['AuditDelta']['old_value'] );
    $this->assertEqual( 'First Test Article (Edited)', $delta['AuditDelta']['new_value'] );
  
    # TEST UPDATE OF MULTIPLE PROPERTIES
    
    # Pause to simulate a gap between edits
    # This also allows us to retrieve the last edit for the next set
    # of tests.
    sleep( 1 );
    
    $updated_article = array(
      'Article' => array(
        'user_id' => 1,
        'title' => 'First Test Article (Second Edit)', 
        'body' => 'First Test Article Body (Also Edited)', 
        'published' => 'Y', 
      ),
    );
    $this->Article->save( $updated_article );
    
    $last_audit = $this->Audit->find(
      'first',
      array(
        'contain'    => array( 'AuditDelta' ),
        'conditions' => array(
          'Audit.event'     => 'EDIT',
          'Audit.model'     => 'Article',
          'Audit.entity_id' => $this->Article->id
        ),
        'order' => 'Audit.created DESC',
      )
    );
    
    $this->assertEqual( 3, count( $last_audit['AuditDelta'] ) );
    $this->assertEqual( 'First Test Article (Edited)', array_shift( Set::extract( '/AuditDelta[property_name=title]/old_value', $last_audit ) ) );
    $this->assertEqual( 'First Test Article (Second Edit)', array_shift( Set::extract( '/AuditDelta[property_name=title]/new_value', $last_audit ) ) );
    
    $this->assertEqual( 'First Test Article Body', array_shift( Set::extract( '/AuditDelta[property_name=body]/old_value', $last_audit ) ) );
    $this->assertEqual( 'First Test Article Body (Also Edited)', array_shift( Set::extract( '/AuditDelta[property_name=body]/new_value', $last_audit ) ) );
    
    $this->assertEqual( 'N', array_shift( Set::extract( '/AuditDelta[property_name=published]/old_value', $last_audit ) ) );
    $this->assertEqual( 'Y', array_shift( Set::extract( '/AuditDelta[property_name=published]/new_value', $last_audit ) ) );
  }
}