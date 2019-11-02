<?php

/**
 * All routes in app
 */
$config['routes'] = [
    ['pattern' => 'index', 'controller' => \Framework\App\Controllers\Hello::class],
    ['pattern' => 'login', 'controller' => \Framework\App\Controllers\Login::class],
    ['pattern' => 'login/register', 'controller' => \Framework\App\Controllers\Login::class, 'method' => 'register']
];

/**
 * Default app route
 */
$config['default_route'] = ['pattern' => 'index', 'controller' => \Framework\App\Controllers\Hello::class, 'method' => NULL];