<?php

namespace VMelnik\Upvote\Controller;

use VMelnik\Framework\Controller\BaseC;

class StoryC extends BaseC
{

    public function index()
    {
        if (!isset($_GET['id'])) {
            header("Location: /");
            exit;
        }

        $storyId = $_GET['id'];
        $story = $this->get('story.m')->getOne($storyId);
        if (!$story) {
            header("Location: /");
            exit;
        }

        $comments = $this->get('comment.m')->getComments($storyId);
        $commentsCount = count($comments);
        $isAuthenticated = $_SESSION['AUTHENTICATED'];

        ob_start();
        include __DIR__ . '/../View/Story/index.phtml';
        $content = ob_get_contents();
        ob_end_clean();

        require_once __DIR__ . '/../View/layout.phtml';
    }

    public function create()
    {
        if (!isset($_SESSION['AUTHENTICATED'])) {
            header("Location: /user/login");
            exit;
        }

        $error = '';
        if (isset($_POST['create'])) {
            if (!isset($_POST['headline']) || !isset($_POST['url']) ||
                    !filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)) {
                $error = 'You did not fill in all the fields or the URL did not validate.';
            } else {
                $id = $this->get('story.m')->addStory($_POST['headline'], $_POST['url'], $_SESSION['username']);
                header("Location: /story/?id=$id");
                exit;
            }
        }

        ob_start();
        include __DIR__ . '/../View/Story/create.phtml';
        $content = ob_get_contents();
        ob_end_clean();

        require_once __DIR__ . '/../View/layout.phtml';
    }

}