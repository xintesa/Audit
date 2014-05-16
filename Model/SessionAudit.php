<?php

App::uses('AuditAppModel', 'Audit.Model');

/**
 * SessionAudit Model
 *
 * @property User $User
 * @property Source $Source
 * @property Session $Session
 */
class SessionAudit extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Source' => array(
			'className' => 'User',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}
