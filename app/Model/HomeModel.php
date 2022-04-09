<?php

namespace app\Model;

use app\lib\DataMapper\HomeDataMapper;

class HomeModel
{
    private HomeDataMapper $homeDataMapper;

    public function __construct()
    {
        $this->setDataMapper();

        return $this;
    }

    public function getStaffUpdates()
    {
        return $this->homeDataMapper->getAllStaffUpdates();
    }

    private function setDataMapper(): void
    {
        $this->homeDataMapper = new HomeDataMapper();
    }
}