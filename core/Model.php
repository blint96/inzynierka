<?php

namespace Framework\Core;

abstract class Model {

    public $db;

    public function __construct(\DI\Container $container)
    {
        $config = $container->get('app.config');

        if($config['mysql']['enabled']) {
            $this->db = $container->get('driver.mysql');
        } else if($config['sqlite']['enabled']) {
            $this->db = $container->get('driver.sqlite');
        }
    }

    public function getDb() {
        return $this->db;
    }

    public static function factory(Controller $controller, $modelClassName) {
        $class = $modelClassName;
        $instance = new $class($controller->getContainer());
        return $instance;
    }
}