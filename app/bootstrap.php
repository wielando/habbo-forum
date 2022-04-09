<?php

use app\lib\Route\Route;
use app\lib\TemplateHandler\TemplateHandler;

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

$route = new Route();

$route->addRoute(['url' => '/', 'name' => 'home'], function() {
    (new TemplateHandler('home'))->renderTemplate();
});

// submit every route
$route->submitRoute();