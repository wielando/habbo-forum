<?php

namespace app\lib\TemplateHandler;

use app\lib\Config\Config;
use app\lib\Route\Route;
use Twig\Environment as TwigEnv;
use Twig\Extension\DebugExtension;
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

    /**
     * @param string $folderToCall
     * @return void
     */
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

    /**
     * @return void
     */
    private function setFilePath(): void
    {
        $this->filePath = Config::PAGE_PATH . $this->folderToCall;
    }


    /**
     * @param array $vars
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderTemplate(array $vars = []): string
    {

        $filesystemLoader = new FilesystemLoader($this->filePath);
        $template = new TwigEnv($filesystemLoader, [
            'debug' => true
        ]);

        $template->addExtension(new DebugExtension());

        return $template->render($this->filename . '.twig', ['stylesheetFolder' => Config::STYLESHEET_PATH, ...$vars]);
    }

}