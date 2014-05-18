<?php
require "../bootstrap/bootstrap.php";
use \IPFilter\IPFilter;
use \BasicAPP\Middleware;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

/**
 * super globales request, response
 */
$GLOBALS['request'] = Request::createFromGlobals();
$GLOBALS['response'] = new Response();
$GLOBALS['response']->headers->set('Content-Type', 'application/json');

/**
 * verificar ip valida
 */

$filter =  new IPFilter( '../app/config/acc_ips.php');
$filter->WatchDog();

/**
 * Es una request Valida
 */
$app = new Middleware('../app/controllers/');
$app->kickStart();
