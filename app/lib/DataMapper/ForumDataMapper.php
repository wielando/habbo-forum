<?php

namespace app\lib\DataMapper;

use app\lib\Connection\Connection;

class ForumDataMapper
{
    private DataMapper $dataMapper;

    public function __construct()
    {
        $this->setDataMapper();

        return $this;
    }

    /**
     * @param int $id
     * @return array
     */
    public function collectAnnouncementThreads(int $id): array
    {
        $statement = 'SELECT th.title, th.thread_type, u.username, u.avatar, p.content FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      LEFT JOIN posts as p ON p.thread_id = th.id
                      WHERE th.thread_type = :threadType';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadType' => $id]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResult();
    }

    /**
     * @param int $id
     * @return array
     */
    public function collectCommunityThreads(int $id): array
    {
        $statement = 'SELECT th.title, th.thread_type, u.username, u.avatar ,p.content FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      LEFT JOIN posts as p ON p.thread_id = th.id
                      WHERE th.thread_type = :threadType';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadType' => $id]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResult();
    }

    /**
     * @param int $id
     * @return array
     */
    public function collectUpdateThreads(int $id): array
    {
        $statement = 'SELECT th.title, th.thread_type, u.username, u.avatar FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      WHERE th.thread_type = :threadType';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadType' => $id]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResult();
    }

    /**
     * @return void
     */
    private function setDataMapper(): void
    {
        $this->dataMapper = new DataMapper(new Connection());
    }
}