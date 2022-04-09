<?php
use app\lib\Route\Route;
use app\lib\TemplateHandler\TemplateHandler;

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