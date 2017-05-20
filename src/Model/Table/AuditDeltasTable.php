<?php

namespace Xintesa\Audit\Model\Table;

use Croogo\Core\Model\Table\CroogoTable as Table;

class AuditDeltasTable extends Table {

	public function setupSearchPlugin()
    {
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
