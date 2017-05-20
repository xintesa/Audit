<?php

use Croogo\Core\Nav;

Nav::add('extensions.children.audit', [
    'title' => 'Audit',
    'url' => array(
        'prefix' => 'admin',
        'plugin' => 'Xintesa/Audit',
        'controller' => 'Audits',
        'action' => 'index',
    ),
    'children' => array(
        'sessions' => array(
            'title' => 'Session Audit',
            'url' => array(
                'prefix' => 'admin',
                'plugin' => 'Xintesa/Audit',
                'controller' => 'SessionAudits',
                'action' => 'index',
            ),
            'weight' => 1,
        ),
        'records' => array(
            'title' => 'Audit Records',
            'url' => array(
                'admin' => true,
                'plugin' => 'Xintesa/Audit',
                'controller' => 'Audits',
                'action' => 'index',
            ),
            'weight' => 5,
        ),
        'setting' => array(
            'title' => 'Settings',
            'url' => array(
                'admin' => true,
                'plugin' => 'Xintesa/Audit',
                'controller' => 'AuditSettings',
                'action' => 'index',
            ),
            'weight' => 10,
        )
    ),
]);
