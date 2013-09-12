<?php

App::uses('AuditAppController', 'Audit.Controller');

class AuditSettingsController extends AuditAppController {

	public $uses = array(
		'Settings.Setting',
	);

	public function admin_index() {

		if ($this->request->is('post') && isset($this->request->data)) {
			$models = $this->request->data['Audit']['models'];
			$models = array_combine(array_values($models), array_values($models));
			$this->Setting->write('Audit.models', json_encode($models));
			return $this->redirect(array('action' => 'index'));
		}
		$plugins = App::objects('plugin');
		$models = array();
		$cakePlugin = new CakePlugin();
		foreach ($plugins as $plugin) {
			if (!$cakePlugin->loaded($plugin)) {
				continue;
			}
			$pluginModels = App::objects($plugin . '.Model');
			foreach ($pluginModels as $pluginModel) {
				if (substr($pluginModel, -8) == 'AppModel') {
					continue;
				}
				$model = $plugin . '.' . $pluginModel;
				$models[$model] = $model;
			}
		}
		$this->request->data = array(
			'Audit' => array(
				'models' => json_decode(Configure::read('Audit.models'), true),
			),
		);
		$this->set(compact('models'));
	}

}
