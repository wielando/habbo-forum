<?php

use app\lib\Route\Route;
use app\lib\TemplateHandler\TemplateHandler;

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

$route = new Route();

// Adding a new standalone page
$route->addRoute(['url' => '/', 'name' => 'home'], function() {
    (new TemplateHandler('home'))->renderTemplate();
});

// submit every route
$route->submitRoute();