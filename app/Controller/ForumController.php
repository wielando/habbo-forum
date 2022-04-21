<?php

namespace app\Controller;

use app\lib\TemplateHandler\TemplateHandler;
use app\Model\ForumModel;

class ForumController implements ControllerInterface
{
    private array $vars = [];
    private ForumModel $forumModel;

    private int $communityTabId = 1;
    private int $announcementTabId = 2;
    private int $updateTabId = 3;


    public function displayForum()
    {
        $this->setForumModel();
        $this->setUpThreads();

        echo (new TemplateHandler('forum', '/forum'))->renderTemplate([
            'announcementThreads' => $this->vars['announcementThreads'],
            'communityThreads' => $this->vars['communityThreads'],
            'updateThreads' => $this->vars['updateThreads']
        ]);
    }

    private function setUpThreads()
    {
        $this->setUpAnnouncementThreads();
        $this->setUpCommunityThreads();
        $this->setUpUpdateThreads();
    }

    private function setForumModel(): void
    {
        $this->forumModel = new ForumModel();
    }

    /**
     * @return void
     */
    private function setUpAnnouncementThreads(): void
    {
        $this->vars['announcementThreads'] = $this->forumModel->getAnnouncementThreads($this->announcementTabId);
    }

    /**
     * @return void
     */
    private function setUpCommunityThreads(): void
    {
        $this->vars['communityThreads'] = $this->forumModel->getCommunityThreads($this->communityTabId);
    }

    /**
     * @return void
     */
    private function setUpUpdateThreads(): void
    {
        $this->vars['updateThreads'] = $this->forumModel->getUpdateThreads($this->updateTabId);
    }
}