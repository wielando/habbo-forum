<?php

namespace app\controller\home;

use app\controller\ControllerInterface;
use app\lib\TemplateHandler\TemplateHandler;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController implements ControllerInterface
{
    public function __construct()
    {
        echo $this->renderPage();
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     *
     * @return string
     */
    public function renderPage(): string
    {
        return (new TemplateHandler('home'))->renderTemplate();
    }
}