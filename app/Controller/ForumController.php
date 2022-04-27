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

    private array $messages = [
        'error' => [
            'post' => [
                'toLong' => 'Dein Beitrag beinhaltet zu viele Zeichen und kann daher nicht verschickt werden!',
                'toShort' => 'Dein Beitrag muss mindestens 10 Zeichen beinhalten!',
                'unknownError' => 'Whouups, da ist ein Fehler aufgetreten! Bitte versuche es erneut oder melde dich bei einem Admin!'
            ],
            'thread' => [
                'noThreadFound' => 'Thread wurde nicht gefunden!'
            ]
        ],

        'success' => [
            'post' => [
                'postCommited' => 'Super, dein Beitrag wurde erfolgreich gepostet!',
                'editCommited' => 'Dein Beitrag wurde erfolgreich bearbeitet!',
                'deletedCommited' => 'Dein Beitrag wurde erfolgreich gelöscht!'
            ]
        ]
    ];


    public function displayForum()
    {
        $this->setForumModel();
        $this->setUpThreads();

        $this->vars['threadPosts'] = false;

        if (isset($_GET['thread']) && is_numeric($_GET['thread'])) {
            $this->displayPost();
        }

        echo (new TemplateHandler('forum', '/forum'))->renderTemplate([
            'announcementThreads' => $this->vars['announcementThreads'],
            'communityThreads' => $this->vars['communityThreads'],
            'threadPosts' => $this->vars['threadPosts']
        ]);
    }

    /**
     * @return void
     */
    public function displayPost(): void
    {
        $newPost = false;

        if (isset($_POST['comment-submit']) && !empty($_POST['comment'])) {
            $this->commitPostToThread();
            $newPost = true;
        }

        $this->setUpThreadData();

        (new TemplateHandler('thread', '/forum'))->displayTemplate([
            'threadPosts' => $this->vars['threadPosts'],
            'threadTitle' => $this->forumModel->getThreadTitleById($_GET['thread'])['title'],
            'errorMessages' => (isset($this->vars['commentErrorsNotification'])) ? $this->vars['commentErrorsNotification'] : false,
            'successMessage' => (isset($this->vars['commentSuccessNotification'])) ? $this->vars['commentSuccessNotification'] : false,
            'newPost' => $newPost
        ]);
    }

    private function commitPostToThread(): bool
    {
        /**
         * TODO: STRING SHIT
         */
        $userComment = htmlspecialchars($_POST['comment']);
        $threadId = $_GET['thread'];

        if (strlen($userComment) > 500) {
            $this->vars['commentErrorsNotification'][] = $this->messages['error']['post']['toLong'];
        } else if (strlen($userComment) < 10) {
            $this->vars['commentErrorsNotification'][] = $this->messages['error']['post']['toShort'];
        }

        if (isset($this->vars['commentErrorsNotification']) && count($this->vars['commentErrorsNotification']) > 0) {
            return false;
        }

        $isCommited = $this->forumModel->createThreadPost($threadId, 1, $userComment);

        if (!$isCommited) {
            $this->vars['commentErrorsNotification'][] = $this->messages['error']['post ']['toShort'];
            return false;
        }

        $this->vars['commentSuccessNotification'][] = $this->messages['success']['post']['postCommited'];

        return true;
    }

    /**
     * Collects Thread Meta Information and post data
     *
     * @return void
     */
    private function setUpThreadData()
    {
        $this->setUpThreadPosts();
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

            if ($this->isUserThreadCreator($userPost['thread_id'], $userPost['user_id'])) {
                $userPosts[$key]['isOp'] = true;
                $userPosts[$key]['ranks'][]['rank_name'] = 'op';
            } else {
                $userPosts[$key]['isOp'] = false;
            }
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