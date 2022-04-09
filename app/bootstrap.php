<?php

use app\controller\home\HomeController;
use app\lib\Config\Config;
use app\lib\Route\Route;
use app\lib\TemplateHandler\TemplateHandler;

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

require_once Config::MAIN_PATH . '/vendor/autoload.php';

$route = new Route();

$route->addRoute(['url' => '/example', 'name' => 'example'], function() {
    echo (new TemplateHandler('example'))->renderTemplate(['name' => 'Wieland']);
});

$route->addRoute(['url' => '/home', 'name' => 'home'], function() {
    return new HomeController();
});

// submit every route
$route->submitRoute();