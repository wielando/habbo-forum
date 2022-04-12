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
    public function getAnnouncementThreads(int $id): array
    {
        return $this->forumDataMapper->collectAnnouncementThreads($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCommunityThreads(int $id): array
    {
        return $this->forumDataMapper->collectCommunityThreads($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getUpdateThreads(int $id): array
    {
        return $this->forumDataMapper->collectUpdateThreads($id);
    }

    public function setDataMapper(): ForumDataMapper
    {
        return $this->forumDataMapper = new ForumDataMapper();
    }

}