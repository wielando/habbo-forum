<?php

namespace app\lib\Route;

use app\lib\TemplateHandler\TemplateHandler;

class Route
{
    private array $routes;
    public static string $currentPath = '/';

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $this->setCurrentPath();
        }
    }

    /**
     * @return void
     */
    private function setCurrentPath()
    {
        $currentRoute = rtrim($_GET['url'], '/');
        Route::$currentPath = $currentRoute;
    }

    /**
     * Adds an Route with callback.
     * The callback could be a controller or a rendered site
     *
     * @param $method
     * @param array $route
     * @param $callback
     * @return bool
     */
    public function addRoute($method, array $route, $callback = null): bool
    {
        if (!$this->validateRoute($route, $method))
            return false;

        $this->routes[] = [
            'method' => $method,
            'url' => $route['url'],
            'callback' => (isset($callback)) ? $callback : null
        ];

        return true;
    }


    /**
     * Make sure that the route array contains needed keys
     * and has a validate method. Also, it validates the
     * given parameter
     *
     * @param array $route
     * @param string $method
     * @return bool
     */
    private function validateRoute(array $route, string $method): bool
    {
        if (!array_key_exists('url', $route)) {
            return false;
        }

        if (!$this->validateMethod($method)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $method
     * @return bool
     */
    private function validateMethod(string $method): bool
    {

        $methodType = match ($method) {
            'GET', 'POST' => $method,
            default => null,
        };

        if ($methodType === null)
            return false;

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

            if (Route::$currentPath !== $route['url']) {
                continue;
            }

            //TODO MIDDLEWARE CALL
            return $route['callback']();
        }
    }
}