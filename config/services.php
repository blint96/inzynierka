<?php

// database configs
require 'config/database.php';

return [
    'driver.mysql' => new \Framework\Core\DBDrivers\MySQLDriver($config['mysql']['host'], $config['mysql']['port'],
        $config['mysql']['user'], $config['mysql']['password'], $config['mysql']['database']),

    'driver.sqlite' => new \Framework\Core\DBDrivers\SQLiteDriver($config['sqlite']['file']),

    'model.user' => function($container) { return new \Framework\App\Models\User($container); }
];