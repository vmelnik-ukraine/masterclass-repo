<?php

namespace VMelnik\Upvote\Controller;

use VMelnik\Framework\Controller\BaseC;

class IndexC extends BaseC
{

    public function index()
    {
        $stories = $this->get('story.m')->getStories();
        if ($stories) {
            $commentModel = $this->get('comment.m');
            for ($i = 0; $i < count($stories); $i++) {
                $stories[$i]['comments_count'] = $commentModel->getCommentsCount($stories[$i]['id']);
            }
        }

        ob_start();
        include __DIR__ . '/../View/Index/index.phtml';
        $content = ob_get_contents();
        ob_end_clean();

        require __DIR__ . '/../View/layout.phtml';
    }

}