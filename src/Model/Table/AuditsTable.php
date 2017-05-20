<?php

namespace Xintesa\Audit\Model\Table;

use Cake\ORM\Table;

class AuditsTable extends Table {

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
