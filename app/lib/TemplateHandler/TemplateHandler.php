<?php

namespace app\lib\TemplateHandler;

use Twig;

class TemplateHandler
{
    private string $site;

    public function __construct($site)
    {
        $this->site = $site;

        return $this;
    }

    public function renderTemplate()
    {

    }
}