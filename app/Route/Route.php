<?php

namespace app\Route;

use app\TemplateHandler\TemplateHandler;

class Route
{
    private array $urls = array();
    public static string $path = '/';

    private TemplateHandler $templateHandler;

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $urlParam = rtrim($_GET['url'], '/');
            Route::$path = $urlParam;
        }
    }

    public function setTemplateHandler(TemplateHandler $templateHandler)
    {
        $this->templateHandler = $templateHandler;
    }

    public function add(string $url, $callback)
    {
        $this->urls[] = ['url' => strtolower($url), 'callback' => $callback];
        return $this;
    }

    /**
     * Submit current Route
     *
     * @return array|null
     */
    public function submit()
    {
        if (isset($_GET['url'])) {
            $currentUrl = rtrim($_GET['url'], '/');
        } else {
            $currentUrl = '/';
        }

        foreach ($this->urls as $url) {
            if ($url['url'] == $currentUrl) {
                /*echo '<pre>';
                var_dump($url['callback']($this->templateHandler));
                echo '</pre>';*/
                return $url['callback']($this->templateHandler);
            }
        }


    }

}