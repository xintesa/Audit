<?php

CroogoNav::add('extensions.children.audit', array(
	'title' => 'Audit',
	'url' => array(
		'admin' => true,
		'plugin' => 'audit',
		'controller' => 'audits',
		'action' => 'index',
	),
));
