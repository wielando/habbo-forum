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

/**
 * Aufruf Struktur sieht folgendermaßen aus:
 * Beispiel: /example/test
 * Beispiel aufgebröselt: /{folder}/{folder}/{site}
 *
 * Ordner Beispiel:
 *
 *  example >
 *      test >
 *          test.twig
 *          test2.twig
 *
 * Wenn URL /example/test angegeben wird, wird geprüft, ob im Ordner test eine Datei mit dem selben Ordnernamen
 * liegt. Ja = rufe auf. Nein = 404
 *
 * Ruft man /example/test/test2.twig auf
 * wird die letzte Angabe in der URL als File aufgelöst
 */

$route->addRoute(['url' => '/example/test', 'name' => 'test'], function() {
    echo (new TemplateHandler('test'))->renderTemplate(['name' => 'Wieland']);
});

$route->addRoute(['url' => '/example/test2', 'name' => 'test2'], function() {
    echo (new TemplateHandler('test2'))->renderTemplate(['name' => 'Wieland']);
});

$route->addRoute(['url' => '/home', 'name' => 'home'], function() {
    return new HomeController();
});

// submit every route
$route->submitRoute();