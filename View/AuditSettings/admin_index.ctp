<?php

$this->viewVars['title_for_layout'] = __d('audit', 'Audit Settings');

echo $this->Form->create(false);

echo $this->Form->input('Audit.models', array(
	'label' => __d('audit', 'Audited Models'),
	'multiple' => 'checkbox',
	'options' => $models,
));

echo $this->Form->submit('Save');

echo $this->Form->end();
