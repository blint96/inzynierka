<?php

namespace Framework\Core;

abstract class Model {

    public $db;

    public function __construct(\DI\Container $container)
    {
        $this->db = $container->get('driver.mysql');
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