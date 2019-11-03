<?php

namespace Framework\Core;

/**
 * App router
 */
class Router {

    /**
     * URI Segments
     */
    private $segments;

    /**
     * Existing routes
     * @var
     */
    private $routes;

    /**
     * Default app route
     * @var
     */
    private $default_route;

    /**
     * Present route set
     * @var
     */
    private $present_route;

    /**
     * Constructor
     */
    public function __construct($routes, $default_route) {
        $this->segments = array_slice(explode("/", $_SERVER["REQUEST_URI"] ),1);
        $this->routes = $routes;
        $this->default_route = $default_route;
    }

    public function explodeSegments($segments) {
        return explode("/", $segments);
    }

    public function implodeSegments($segments) {
        $implode = "";
        foreach($segments as $key => $s) {
            $implode .= $s;
            if ($key !== array_key_last($segments))
                $implode .= "/";
        }

        return $implode;
    }

    public function route($givenRoutes = NULL) {
        if($this->hasRoute()) {
            if($givenRoutes === NULL) $givenRoutes = $this->implodeSegments($this->segments);
            $found = "";
            $method = NULL;
            $controller = NULL;

            foreach($this->routes as $r) {
                if($r['pattern'] === $givenRoutes) {
                    $found = $givenRoutes;
                    $controller = $r['controller'];
                    if(isset($r['method']))
                        $method = $r['method'];
                    break;
                }
            }

            if(strlen($found) === 0) {
                $array = $this->explodeSegments($givenRoutes);
                array_pop($array);

                // break recurrency if no route found in last iteration
                if($givenRoutes !== NULL && count($this->explodeSegments($givenRoutes)) === 1)
                    throw new \Exception("No route.");

                return $this->route($this->implodeSegments($array));
            } else {
                $this->present_route = $found;
                return ['pattern' => $found, 'method' => $method, 'controller' => $controller];
            }
        } else {
            $this->present_route = $this->default_route['pattern'];
            return $this->default_route;
        }
    }

    /**
     * Get URI segments
     */
    public function getSegments() {
        return $this->segments;
    }

    /**
     * Any route specified?
     */
    public function hasRoute() {
       return count($this->segments) !== 0 && strlen($this->segments[0]) > 0;
    }
}