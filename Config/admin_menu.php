<?php

CroogoNav::add('extensions.children.audit', array(
	'title' => 'Audit',
	'url' => array(
		'admin' => true,
		'plugin' => 'audit',
		'controller' => 'audits',
		'action' => 'index',
	),
	'children' => array(
		'records' => array(
			'title' => 'Audit Records',
			'url' => array(
				'admin' => true,
				'plugin' => 'audit',
				'controller' => 'audits',
				'action' => 'index',
			),
			'weight' => 1,
		),
		'setting' => array(
			'title' => 'Settings',
			'url' => array(
				'admin' => true,
				'plugin' => 'audit',
				'controller' => 'audit_settings',
				'action' => 'index',
			),
			'weight' => 5,
		)
	),
));
