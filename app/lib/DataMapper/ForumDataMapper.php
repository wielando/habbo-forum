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
        $statement = 'SELECT th.title, th.thread_type, u.username, u.avatar, th.id FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      WHERE th.thread_type = :threadType';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadType' => $id]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResults();
    }

    /**
     * @param int $id
     * @return array
     */
    public function collectCommunityThreads(int $id): array|bool
    {
        $statement = 'SELECT th.title, th.thread_type, u.username, u.avatar, th.id FROM threads as th
                      LEFT JOIN users as u ON th.creator_id = u.id
                      WHERE th.thread_type = :threadType';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadType' => $id]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResults();
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

        return $this->dataMapper->fetchResults();
    }

    public function collectThreadPosts(int $threadId): array
    {
        $statement = 'SELECT u.username, u.avatar, u.id as user_id, p.content, th.id as thread_id, p.date FROM posts as p 
                      LEFT JOIN users as u ON p.user_id = u.id
                      LEFT JOIN threads as th ON p.thread_id = th.id
                      WHERE th.id = :threadId';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadId' => $threadId]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResults();
    }

    public function collectThreadCreatorUserId(int $threadId): array
    {
        $statement = 'SELECT u.id FROM users as u
                      LEFT JOIN threads as th ON th.creator_id = u.id
                      WHERE th.id = :threadId';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadId' => $threadId]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResult();
    }

    public function collectThreadTitleById(int $threadId): array
    {
        $statement = 'SELECT title FROM threads WHERE id = :threadId';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['threadId' => $threadId]);
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

    public function insertThreadPost(int $threadId, int $userId, string $content): bool
    {
        $statement = 'INSERT INTO posts (user_id, thread_id, content, date) VALUES (:userId, :threadId, :content, :date)';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['userId' => $userId, 'threadId' => $threadId, 'content' => $content, 'date' => time()]);
        return $this->dataMapper->executeStmt();
    }
}