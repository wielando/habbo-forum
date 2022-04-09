<?php

namespace app\lib\Route;

use app\lib\TemplateHandler\TemplateHandler;

class Route
{
    private array $routes;
    public static string $path = '/';

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $urlParam = rtrim($_GET['url'], '/');
            Route::$path = $urlParam;
        }
    }

    /**
     * Adds an Route with callback.
     * The callback could be a controller or a rendered site
     *
     * @param array $route
     * @param $callback
     * @return bool
     */
    public function addRoute(array $route, $callback): bool
    {
        if (!$this->validateRoute($route))
            return false;

        $this->routes[] = [
            'url' => $route['url'],
            'callback' => (isset($callback)) ? $callback : null
        ];

        return true;
    }

    /**
     * Make sure that the route array contains needed keys
     *
     * @param array $route
     * @return bool
     */
    private function validateRoute(array $route): bool
    {
        if (!array_key_exists('url', $route)) {
            return false;
        }

        return true;
    }

    /**
     * Is called every site reload and makes
     * sure that the called page is in our array.
     *
     * Calls the callback
     *
     * @return mixed|void
     */
    public function submitRoute()
    {
        foreach ($this->routes as $route) {
            if (Route::$path !== $route['url']) {
                continue;
            }

            return $route['callback']();
        }

        $this->fallbackRoute();
    }


    private function fallbackRoute()
    {
        //echo (new TemplateHandler('404'))->renderTemplate();

        exit;
    }
}