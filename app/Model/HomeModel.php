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

    /**
     * @param int $rank
     * @return bool|array
     */
    public function getStaffsByRank(int $rank): bool|array
    {
        return $this->homeDataMapper->collectStaffsByRank($rank);
    }

    /**
     * @return bool|array
     */
    public function getAllStaffUpdates(): bool|array
    {
        return $this->homeDataMapper->collectAllStaffUpdates();
    }

    /**
     * @return void
     */
    private function setDataMapper(): void
    {
        $this->homeDataMapper = new HomeDataMapper();
    }
}