<?php

App::uses('AuditAppController', 'Audit.Controller');

class AuditDeltasController extends AuditAppController {


	public $uses = array(
		'Audit.AuditDelta',
	);

	public $components = array(
		'Search.Prg',
	);

	public $presetVars = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->AuditDelta->setupSearchPlugin();
		$this->Prg = $this->Components->load('Search.Prg', array(
			'presetForm' => array(
				'paramType' => 'querystring',
			),
			'commonProcess' => array(
				'paramType' => 'querystring',
				'filterEmpty' => true,
			)
		));
	}

	public function admin_index() {
		$this->Prg->commonProcess();
		$criteria = $this->AuditDelta->parseCriteria($this->request->query);
		$auditDeltas = $this->paginate($criteria);
		$this->set(compact('auditDeltas'));
	}

}
