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
		'sessions' => array(
			'title' => 'Session Audit',
			'url' => array(
				'admin' => true,
				'plugin' => 'audit',
				'controller' => 'session_audits',
				'action' => 'index',
			),
			'weight' => 1,
		),
		'records' => array(
			'title' => 'Audit Records',
			'url' => array(
				'admin' => true,
				'plugin' => 'audit',
				'controller' => 'audits',
				'action' => 'index',
			),
			'weight' => 5,
		),
		'setting' => array(
			'title' => 'Settings',
			'url' => array(
				'admin' => true,
				'plugin' => 'audit',
				'controller' => 'audit_settings',
				'action' => 'index',
			),
			'weight' => 10,
		)
	),
));
