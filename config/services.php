<?php

// database configs
require_once 'config/database.php';

return [
    'driver.mysql' => new \Framework\Core\DBDrivers\MySQLDriver($config['mysql']['host'], $config['mysql']['port'],
        $config['mysql']['user'], $config['mysql']['password'], $config['mysql']['database']),

    'model.user' => function($container) { return new \Framework\App\Models\User($container); }
];