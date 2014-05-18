<?php
require "../bootstrap/bootstrap.php";
use \IPFilter\IPFilter;
use \BasicAPP\Middleware;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Katzgrau\KLogger\Logger;
use \Psr\Log\LogLevel;
/**
 * super globales request, response, logger
 */
/*
LOG LEVELS
LogLevel::EMERGENCY;
LogLevel::ALERT;
LogLevel::CRITICAL;
LogLevel::ERROR;
LogLevel::WARNING;
LogLevel::NOTICE;
LogLevel::INFO;
LogLevel::DEBUG;
*/


$GLOBALS['request']  = Request::createFromGlobals();
$GLOBALS['response'] = new Response();
$GLOBALS['logger']   = new Logger('../app/logs', LogLevel::DEBUG);
$GLOBALS['response']
	->headers
	->set('Content-Type', 'application/json');

/**
 * verificar ip valida
 */

$filter =  new IPFilter( '../app/config/acc_ips.php');
$filter->WatchDog();

/**
 * Es una request Valida
 */
$app = new Middleware('../app/controllers/');
$found = $app->kickStart();

/**
 * not found
 */
if($found === false) {
    $GLOBALS['response']->setContent("{'status': 404}");
    $GLOBALS['response']->send();
}
