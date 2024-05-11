<?php

/**
 * 
 * @KEVAO18
 * 
 */

session_start();

require('vendor/autoload.php');

use Dotenv\Dotenv as de;

$dotenv = de::createImmutable(__DIR__);

$dotenv->load();

require_once('http/config/routes.php');

use config\routesController;

$ruta = new routesController();

?>