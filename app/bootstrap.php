<?php

use app\Route\Route;
use app\TemplateHandler\TemplateHandler;
use app\Config\Config;

require_once 'Config/Config.php';
require_once 'pages.php';

spl_autoload_register(function ($class) {
    require_once($class . '.php');
});

$templateHandler = new TemplateHandler(Config::PAGE_PATH);

$route = new Route();
$route->setTemplateHandler($templateHandler);


/**
 * Create Callback Function that returns the current Template
 */

/**
 * achtung hier ist abhängigkeit von templatehandler. anonyme funktion benötigt einen aufruf mit templatehandler callback
 */
foreach($pages as $site) {
    $route->add($site["url"], function(TemplateHandler $templateHandler) use($site) {
        $tpl = $templateHandler->renderTemplate("site");
    });
}

$route->submit();