<?php

namespace app\lib\TemplateHandler;

use app\lib\Config\Config;
use app\lib\Route\Route;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader as FilesystemLoader;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TemplateHandler
{
    private string $pageName = '/';
    private string $filePath = '/';

    private array $vars = [];

    /**
     * @param string $pageName
     */
    public function __construct(string $pageName)
    {
        $this->setPageName($pageName);
        $this->setFilePath();

        return $this;
    }

    /**
     * @param string $pageName
     * @return void
     */
    private function setPageName(string $pageName): void
    {
        $this->pageName = $pageName;
    }

    private function setFilePath(): void
    {
        $this->filePath = Config::PAGE_PATH . Route::$path;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function renderTemplate($vars = []): string
    {
    echo $this->filePath;
        $filesystemLoader = new FilesystemLoader($this->filePath);
        $template = new Twig($filesystemLoader);

        return $template->render($this->pageName . '.twig', $vars);
    }

}