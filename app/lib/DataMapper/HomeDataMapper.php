<?php

namespace app\lib\DataMapper;

use app\lib\Connection\Connection;
use PDOStatement;

class HomeDataMapper
{
    private DataMapper $dataMapper;

    public function __construct()
    {
        $this->setDataMapper();

        return $this;
    }

    private function setDataMapper(): void
    {
        $this->dataMapper = new DataMapper(new Connection());
    }

    public function collectAllStaffUpdates(): bool|array
    {
        $statement = 'SELECT th.title, u.username, u.avatar, p.content FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      LEFT JOIN posts as p ON th.id = p.thread_id';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResults();
    }

    public function collectStaffsByRank(int $rank): bool|array
    {
        $statement = 'SELECT u.username, u.avatar FROM users as u
                      LEFT JOIN rank as r ON r.rank_id = u.rank
                      WHERE u.rank = :rank';


        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['rank' => $rank]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResults();
    }

}