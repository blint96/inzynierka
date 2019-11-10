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
require_once __DIR__. '/config/config.php';
require_once __DIR__. '/config/database.php';

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
$container->set("app.router", $router); // assign router to container
$container->set("app.config", $config); // assign config to container

/*
 *---------------------------------------------------------------
 * SESSION
 *---------------------------------------------------------------
 */
if($config['session']['enabled']) {
    $session = new \Framework\Core\Session();
    $container->set("app.session", $session);
}

/*
 *---------------------------------------------------------------
 * INIT APP
 *---------------------------------------------------------------
 */
$class = \Framework\Core\Controller::factory($target['controller']);
$class->setContainer($container);

// fire method
if($target['method'] !== NULL)
    $class->{$target['method']}();
else
    $class->{"index"}();