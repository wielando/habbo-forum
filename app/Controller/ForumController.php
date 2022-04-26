<?php

namespace app\Controller;

use app\lib\DataMapper\UserDataMapper;
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

        $this->vars['threadPosts'] = false;

        if (isset($_GET['thread']) && is_numeric($_GET['thread'])) {
            $this->setUpThreadData();
        }

        if (isset($_GET['thread']) && is_numeric($_GET['thread'])) {
            echo "HI";
            $this->displayPost();
        }

        echo (new TemplateHandler('forum', '/forum'))->renderTemplate([
            'announcementThreads' => $this->vars['announcementThreads'],
            'communityThreads' => $this->vars['communityThreads'],
            'threadPosts' => $this->vars['threadPosts']
        ]);
    }

    public function displayPost(): void
    {
        echo (new TemplateHandler('thread', '/forum'))->displayTemplate([
            'threadPosts' => $this->vars['threadPosts']
        ]);
    }

    /**
     * Collects Thread Meta Information and post data
     *
     * @return void
     */
    private function setUpThreadData()
    {
        $this->setUpThreadPosts();
        $this->vars['threadPosts']['thread_title'] = $this->forumModel->getThreadTitleById($_GET['thread'])['title'];
    }

    private function setUpThreadPosts()
    {
        $userDataMapper = new UserDataMapper();

        $currentThreadId = $_GET['thread'];
        $userPosts = $this->forumModel->getThreadPosts($currentThreadId);

        //TODO: Fallback
        if (!$userPosts)
            return;

        foreach ($userPosts as $key => $userPost) {
            $userPosts[$key]['ranks'] = $userDataMapper->getRankFromUserById($userPost['user_id']);

            if ($this->isUserThreadCreator($userPost['thread_id'], $userPost['user_id']))
                $userPosts[$key]['isOp'] = true;
        }

        $this->vars['threadPosts'] = $userPosts;
    }

    private function isUserThreadCreator(int $threadId, int $userId): bool
    {
        $creatorId = $this->forumModel->getThreadCreatorUserId($threadId)['id'];

        if ($userId !== $creatorId)
            return false;

        return true;
    }

    private function setUpThreads()
    {
        $this->setUpAnnouncementThreads();
        $this->setUpCommunityThreads();
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

}