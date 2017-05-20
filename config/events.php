<?php

$handlers = array();
if (Configure::read('Audit.installed')) {
	$handlers = array(
		'Audit.AuditEventHandler',
	);
}

$config = array(
	'EventHandlers' => $handlers,
);
