<?php

App::uses('Model', 'Model');

class Audit extends Model {

	public function setupSearchPlugin() {
		$this->order = 'Audit.created DESC';
		$this->filterArgs = array(
			'event' => array('type' => 'value'),
			'model' => array('type' => 'value'),
			'entity_id' => array('type' => 'value'),
		);
		$this->Behaviors->load('Search.Searchable');
	}
}
