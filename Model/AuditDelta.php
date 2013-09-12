<?php

App::uses('Model', 'Model');

class AuditDelta extends Model {

	public function setupSearchPlugin() {
		$this->order = 'AuditDelta.property_name';
		$this->filterArgs = array(
			'audit_id' => array('type' => 'value'),
			'property_name' => array('type' => 'value'),
			'old_value' => array('type' => 'value'),
			'new_value' => array('type' => 'value'),
		);
		$this->Behaviors->load('Search.Searchable');
	}
}
