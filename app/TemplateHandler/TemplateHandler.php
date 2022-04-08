<?php

namespace app\TemplateHandler;

use Twig;

class TemplateHandler
{
    private string $templatePath = '';

    public function __construct(string $templatePath) {
        $this->templatePath = $templatePath;
    }

    public function renderTemplate(string $site)
    {
        return "hello";
    }

    public function display(bool $state)
    {

    }
}