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
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function renderPage(): string
    {
        return (new TemplateHandler('home'))->renderTemplate();
    }
}