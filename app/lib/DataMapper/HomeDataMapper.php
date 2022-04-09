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

    private function setDataMapper(): DataMapper
    {
        return $this->dataMapper = new DataMapper(new Connection());
    }

    public function getAllStaffUpdates()
    {
        $statement = 'SELECT th.title, u.username, u.avatar, p.content FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      LEFT JOIN posts as p ON th.id = p.thread_id';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResult();
    }

}