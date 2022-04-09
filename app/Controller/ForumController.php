<?php

namespace app\Controller;

use app\lib\TemplateHandler\TemplateHandler;

class ForumController implements ControllerInterface
{
    private array $vars = [];

    public function __construct()
    {
        echo $this->renderPage();
    }

    /**
     * @return string
     */
    public function renderPage()
    {
        return (new TemplateHandler('forum', '/forum'))->renderTemplate();
    }
}