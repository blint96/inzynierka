<?php

/*
 *---------------------------------------------------------------
 * PHP AUTOLOADER
 *---------------------------------------------------------------
 */
$loader = require_once __DIR__ . '/vendor/autoload.php';

/*
 *---------------------------------------------------------------
 * CONFIG FILES
 *---------------------------------------------------------------
 */
require_once __DIR__. '/config/routes.php';

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 */
define('ENV', 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */
switch(ENV) {
	case 'development':
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
		ini_set('display_startup_errors', 1);
		break;
	case 'production':
		ini_set('display_errors', 0);
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1);
}

/*
 *---------------------------------------------------------------
 * WHOOPS ERROR REPORTING
 *---------------------------------------------------------------
 */
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/*
 *---------------------------------------------------------------
 * DEPENDENCY INJECTION
 *---------------------------------------------------------------
 */
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions('config/services.php');
if(ENV == "production") {
	$builder->enableCompilation(__DIR__ . '/tmp');
	$builder->writeProxiesToFile(true, __DIR__ . '/tmp/proxies');
}
$container = $builder->build();

/*
 *---------------------------------------------------------------
 * APP ROUTER
 *---------------------------------------------------------------
 */
$router = new \Framework\Core\Router($config['routes'], $config['default_route']);
$target = $router->route();

$class = \Framework\Core\Controller::factory($target['controller'], $target['method']);
$class->setContainer($container);
$class->test();

// TODO: make routing here and inject router into controller
// TODO: add to router every route specified in controllers
// for purposes like: redirect from one controller to other

//$controller = new \Framework\App\Controllers\Hello();
//$controller->setContainer($container);
//$controller->test();
