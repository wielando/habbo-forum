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
    private string $site = '/';
    private array $vars = [];

    /**
     * @param $site
     */
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
    public function renderTemplate($vars = []): string
    {
        $fullPath = Config::PAGE_PATH . '\\' . $this->site;
        $file = $this->site . '.twig';

        $filesystemLoader = new FilesystemLoader($fullPath);
        $template = new Twig($filesystemLoader);

        return $template->render($file, $vars);
    }

}