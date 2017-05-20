<?php

namespace Xintesa\Audit\Model\Table;

use Croogo\Core\Model\Table\CroogoTable as Table;

/**
 * SessionAudits Table
 *
 */
class SessionAuditsTable extends Table {

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsTo('Users', [
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ]);
        $this->belongsTo('Sources', [
            'className' => 'User',
            'foreignKey' => 'source_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ]);
    }

}
