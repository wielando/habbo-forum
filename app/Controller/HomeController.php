<?php

namespace app\Controller;

use app\Controller\ControllerInterface;
use app\lib\TemplateHandler\TemplateHandler;
use app\Model\HomeModel;

class HomeController implements ControllerInterface
{
    private array $vars = [];
    private HomeModel $homeModel;

    public function __construct()
    {
        $this->setHomeModel();
        $this->setupHomeData();

        //echo '<pre>' . var_dump($this->vars) . '</pre>';

        echo $this->renderPage();
    }

    /**
     * @return void
     */
    private function setHomeModel(): void
    {
        $this->homeModel = new HomeModel();
    }

    private function setupHomeData(): array
    {
        $staffUpdates = $this->homeModel->getStaffUpdates();

        return $this->vars['staffUpdates'] = $staffUpdates;
    }

    private function getStaffUpdates()
    {
        return $this->getStaffUpdates();
    }

    public function renderPage(): string
    {
        return (new TemplateHandler('home', '/home'))->renderTemplate([
            'staffUpdates' => $this->vars['staffUpdates'],
        ]);
    }
}