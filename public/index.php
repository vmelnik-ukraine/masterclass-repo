<?php

session_start();

$config = require_once('../config/main.php');

require_once '../src/VMelnik/Framework/Autoloader.php';

Autoloader::registerNamespace('VMelnik', __DIR__ . '/../src/VMelnik');
Autoloader::register();

use VMelnik\Framework\Controller;

$framework = new Controller\MasterController($config);
echo $framework->execute();