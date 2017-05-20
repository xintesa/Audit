<?php

$this->extend('/Common/admin_edit');

$this->viewVars['title_for_layout'] = __d('audit', 'Audit Settings');

$this->Html
	->addCrumb('', '/admin', array('icon' => $_icons['home']))
	->addCrumb(__d('audit', 'Audit Settings'), '/' . $this->request->url);


$this->append('form-start', $this->Form->create(false));

$this->append('tab-content');
	echo $this->Form->input('Audit.models', array(
		'label' => __d('audit', 'Audited Models'),
		'multiple' => 'checkbox',
		'options' => $models,
	));
$this->end();

$this->append('form-end', $this->Form->end());
