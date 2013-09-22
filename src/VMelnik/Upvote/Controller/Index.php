<?php

namespace VMelnik\Upvote\Controller;

use VMelnik\Upvote\Model;

class Index
{

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function index()
    {
        $storyModel = new Model\Story($this->config);
        $stories = $storyModel->getStories();
        if ($stories) {
            $commentModel = new Model\Comment($this->config);
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