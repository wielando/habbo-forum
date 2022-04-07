<?php

use app\Route\Route;

require_once 'Config/Config.php';
require_once 'pages.php';

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

$route = new Route();