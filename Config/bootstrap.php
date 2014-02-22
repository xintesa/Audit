<?php

$auditModels = Configure::read('Audit.models');
if ($auditModels) {
	$models = (array)json_decode($auditModels, true);
	foreach ($models as $model) {
		list(, $model) = explode('.', $model, 2);
		Croogo::hookBehavior($model, 'Audit.Auditable');
	}
}
