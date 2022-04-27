<?php

namespace app\Model;


use app\lib\DataMapper\ForumDataMapper;

class ForumModel implements ModelInterface
{
    private ForumDataMapper $forumDataMapper;

    public function __construct()
    {
        $this->setDataMapper();

        return $this;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAnnouncementThreads(int $threadTypeId): array
    {
        $threads = $this->forumDataMapper->collectAnnouncementThreads($threadTypeId);

        /*foreach ($threads as $key => $thread) {
            $threads[$key]['content'] = substr($thread['content'], 0, 50);
        }*/

        return $threads;
    }

    /**
     * @param int $threadTypeId
     * @return array
     */
    public function getCommunityThreads(int $threadTypeId): array
    {
        $threads = $this->forumDataMapper->collectCommunityThreads($threadTypeId);

        /*foreach ($threads as $key => $thread) {
            $threads[$key]['content'] = substr($thread['content'], 0, 50);
        }*/


        return $threads;
    }

    public function createThreadPost(int $threadId, int $userId, string $content): bool
    {
        return $this->forumDataMapper->insertThreadPost($threadId, $userId, $content);
    }

    /**
     * @param int $threadId
     * @return array|bool
     */
    public function getThreadPosts(int $threadId): array|bool
    {
        $posts = $this->forumDataMapper->collectThreadPosts($threadId);

        if (empty($posts)) {
            return false;
        }

        return $posts;
    }

    public function getThreadTitleById(int $threadId): array|bool
    {
        return $this->forumDataMapper->collectThreadTitleById($threadId);
    }

    public function getThreadCreatorUserId(int $threadId)
    {
        return $this->forumDataMapper->collectThreadCreatorUserId($threadId);
    }

    public function setDataMapper(): ForumDataMapper
    {
        return $this->forumDataMapper = new ForumDataMapper();
    }
}