<?php

class AuditFixture extends TestFixture {

	public $name = 'Audit';

	public $fields = array(
		'id' => ['type' => 'string', 'length' => 36, 'null' => false],
		'event' => ['type' => 'string', 'length' => 255, 'null' => false],
		'model' => ['type' => 'string', 'length' => 255, 'null' => false],
		'entity_id' => ['type' => 'string', 'length' => 36, 'null' => false],
		'json_object' => ['type' => 'text', 'null' => false],
		'description' => ['type' => 'text'],
		'source_id' => ['type' => 'string', 'length' => 255],
		'created' => ['type' => 'datetime']
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	public $records = array();

}
