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

$route->addRoute(['url' => '/registrieren'], function() {
    echo (new TemplateHandler('register', '/example'))->renderTemplate(['name' => 'Wieland']);
});

$route->addRoute(['url' => '/startseite'], function() {
    echo (new TemplateHandler('home', '/example'))->renderTemplate(['name' => 'Wieland']);
});

$route->addRoute(['url' => '/startseite/info'], function() {
    echo (new TemplateHandler('overview', '/example/info'))->renderTemplate(['name' => 'Wieland']);
});

// submit every route
$route->submitRoute();