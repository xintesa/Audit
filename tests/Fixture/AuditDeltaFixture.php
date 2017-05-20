<?php

class AuditDeltaFixture extends TestFixture {

	public $name = 'AuditDelta';

	public $fields = array(
		'id' => ['type' => 'string', 'length' => 36, 'null' => false],
		'audit_id' => ['type' => 'string', 'length' => 36, 'null' => false],
		'property_name' => ['type' => 'string', 'length' => 255, 'null' => false],
		'old_value' => ['type' => 'string', 'length' => 255],
		'new_value' => ['type' => 'string', 'length' => 255]
	);

/**
 * records property
 *
 * @var array
 * @access public
 */
	public $records = array();

}
