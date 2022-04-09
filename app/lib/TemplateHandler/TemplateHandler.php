<?php

namespace app\lib\TemplateHandler;

use app\lib\Config\Config;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader as FilesystemLoader;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TemplateHandler
{
    private string $site;

    private Twig $template;
    private FilesystemLoader $filesystemLoader;

    public function __construct($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function renderTemplate()
    {
        $fullPath = Config::PAGE_PATH . '\\' . $this->site;
        $file = $this->site . '.twig';

        $this->filesystemLoader = new FilesystemLoader($fullPath);
        $this->template = new Twig($this->filesystemLoader);

        echo $this->template->render($file);
    }

}