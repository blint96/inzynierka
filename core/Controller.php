<?php

namespace Framework\Core;

/**
 * Base Controller class that define main methods
 */
abstract class Controller {

	private $container = null;

	public function __construct($method = NULL)
    {
        if($method !== NULL)
            return $this->{$method}();
        else
            return $this->{"index"}();
    }

    public static function factory($className, $method = NULL) {
	    $class = $className;
	    if($method !== NULL) {
            return new $class($method);
        } else {
            return new $class();
        }
    }

    public function test() {
	    var_dump("no i co?");
    }

	public function redirect($url) {
		
	}

	public function setContainer(\DI\Container $container) {
		$this->container = $container;
	}

	public function getContainer() {
		return $this->container;
	}
}