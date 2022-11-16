<?php

session_start();

/*** Error reporting on ***/
error_reporting(E_ALL);

// include_once __DIR__ . '/vendor/autoload.php';

/*** Define the site path ***/
$sitePath = realpath(dirname(__FILE__));
define('__SITE_PATH', $sitePath);

/*** Include the init.php file ***/
include 'includes/init.php';

/*** Load the router ***/
new Router();
