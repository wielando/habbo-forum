<?php

use app\lib\Config\Config;
use app\lib\Route\Route;
use app\lib\TemplateHandler\TemplateHandler;

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

require_once Config::MAIN_PATH . '/vendor/autoload.php';

$route = new Route();

$route->addRoute(['url' => '/', 'name' => 'home'], function() {
    echo (new TemplateHandler('home'))->renderTemplate(['name' => 'Wieland', 'rank' => 1]);
});

// submit every route
$route->submitRoute();