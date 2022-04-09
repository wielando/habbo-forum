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
    private string $filename = '/';
    private string $filePath = '/';
    private string $folderToCall = '/';

    private array $vars = [];

    /**
     * @param string $filename
     * @param string $folderToCall
     */
    public function __construct(string $filename, string $folderToCall)
    {
        $this->setFilename($filename);
        $this->setFolderToCall($folderToCall);
        $this->setFilePath();

        return $this;
    }

    private function setFolderToCall(string $folderToCall)
    {
        $this->folderToCall = $folderToCall;
    }

    /**
     * @param string $filename
     * @return void
     */
    private function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    private function setFilePath(): void
    {
        $this->filePath = Config::PAGE_PATH . $this->folderToCall;
    }


    public function renderTemplate($vars = []): string
    {

        $filesystemLoader = new FilesystemLoader($this->filePath);
        $template = new Twig($filesystemLoader);

        return $template->render($this->filename . '.twig', $vars);
    }

}