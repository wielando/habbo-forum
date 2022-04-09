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
        $this->setupStaffUpdates();
        $this->setupCurrentStaffsData();

        echo $this->renderPage();
    }

    /**
     * @return void
     */
    private function setHomeModel(): void
    {
        $this->homeModel = new HomeModel();
    }

    private function setupStaffUpdates(): void
    {
        $staffUpdates = $this->homeModel->getAllStaffUpdates();

        $this->vars['staffUpdates'] = $staffUpdates;
    }

    private function setupCurrentStaffsData(): void
    {
        $staffs = $this->homeModel->getStaffsByRank(3);

        $this->vars['staffs'] = $staffs;
    }

    public function renderPage(): string
    {
        return (new TemplateHandler('home', '/home'))->renderTemplate([
            'staffUpdates' => $this->vars['staffUpdates'],
            'staffs' => $this->vars['staffs']
        ]);
    }
}