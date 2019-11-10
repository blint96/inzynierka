<?php

namespace Framework\Core;

use mysql_xdevapi\Exception;

/**
 * Base Controller class that define main methods
 */
abstract class Controller {

	private $container = null;

    public static function factory($className) {
	    $class = $className;
	    return new $class();
    }

    public function index() {
        throw new \Exception("Controller has no index() method.");
    }

	public function setContainer(\DI\Container $container) {
		$this->container = $container;

		// bootstrap
        $this->bootstrap();
	}

	public function getContainer() {
		return $this->container;
	}

    /**
     * Bootstrap libraries
     */
	private function bootstrap() {
        $mysql = $this->getContainer()->get('driver.mysql');

        if($mysql->connect()) {
            $mysql->setDatabase("inzynierka");
        }
    }
}