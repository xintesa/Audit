<?php

use Cake\Core\Configure;

$handlers = array();
if (Configure::read('Audit.installed')) {
	$handlers = array(
		'Audit.AuditEventHandler',
	);
}

return [
	'EventHandlers' => $handlers,
];
