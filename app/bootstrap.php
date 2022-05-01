<?php

session_start();

use app\Controller\ForumController;
use app\Controller\HomeController;
use app\lib\Config\Config;
use app\lib\Route\Route;
use app\lib\TemplateHandler\TemplateHandler;

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

require_once Config::MAIN_PATH . '/vendor/autoload.php';

$route = new Route();

$route->addRoute('GET', ['url' => '/home'], function() {
    return (new HomeController())->renderHome();
});

$route->addRoute('GET', ['url' => '/'], function() {
    return (new ForumController())->displayForum();
});

$route->addRoute('GET', ['url' => '/forum'], function() {
    return (new ForumController())->displayForum();
});

// submit every route
$route->submitRoute();