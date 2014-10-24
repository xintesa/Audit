<?php

App::uses('AuditAppController', 'Audit.Controller');

/**
 * SessionAudits Controller
 *
 * @property SessionAudit $SessionAudit
 * @property PaginatorComponent $Paginator
 */
class SessionAuditsController extends AuditAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->SessionAudit->recursive = 0;
		if (empty($this->request->params['named']['direction'])) {
			$this->Paginator->settings['order'] = array(
				'SessionAudit.created' => 'DESC',
			);
		}
		$this->set('sessionAudits', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SessionAudit->exists($id)) {
			throw new NotFoundException(__d('croogo', 'Invalid session audit'));
		}
		$options = array('conditions' => array('SessionAudit.' . $this->SessionAudit->primaryKey => $id));
		$this->set('sessionAudit', $this->SessionAudit->find('first', $options));
	}

}
