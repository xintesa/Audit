<?php

App::uses('AuditAppController', 'Audit.Controller');

class AuditsController extends AuditAppController {

	public $uses = array(
		'Audit.Audit',
	);

	public $presetVars = true;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Audit->setupSearchPlugin();
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
		$criteria = $this->Audit->parseCriteria($this->request->query);
		$audits = $this->paginate($criteria);
		$searchFields = array(
			'event' => array(
				'label' => 'Event',
				'type' => 'select',
				'options' => array(
					'CREATE' => __d('croogo', 'Create'),
					'EDIT' => __d('croogo', 'Edit'),
					'DELETE' => __d('croogo', 'Delete'),
				),
			),
			'model',
			'entity_id' => array('label' => 'Entity', 'type' => 'text')
		);
		$this->set(compact('searchFields', 'audits'));
	}

	public function admin_view($id = null) {
		if (empty($id)) {
			$this->Session->setFlash(__d('audit', 'Invalid audit record'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Audit->bindModel(array(
			'hasMany' => array(
				'AuditDelta',
			),
		));
		$audit = $this->Audit->findById($id);
		if (empty($audit)) {
			throw new NotFoundException();
		}
		$this->set(compact('audit'));
	}

}
