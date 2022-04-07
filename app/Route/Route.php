<?php

namespace app\Route;

class Route
{
    private array $urls = array();
    public static string $path = '/';

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $urlParam = rtrim($_GET['url'], '/');
            Route::$path = $urlParam;
        }
    }

    public function add(string $url, string $callback)
    {

    }



}