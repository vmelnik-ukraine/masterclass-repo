<?php

namespace VMelnik\Upvote\Controller;

use VMelnik\Framework\Controller\BaseC;

class CommentC extends BaseC
{

    public function create()
    {
        if (!isset($_SESSION['AUTHENTICATED'])) {
            die('not auth');
            header("Location: /");
            exit;
        }

        $this->get('comment.m')->create($_SESSION['username'], $_POST['story_id'], $_POST['comment']);
        header("Location: /story/?id=" . $_POST['story_id']);
    }

}