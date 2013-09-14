<?php

namespace VMelnik\Upvote\Controller;

use VMelnik\Upvote\Model;

class Comment {
    
    protected $commentModel;
    
    public function __construct($config) {
        $this->commentModel = new Model\Comment($config);
    }
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            die('not auth');
            header("Location: /");
            exit;
        }
        
        $this->commentModel->create($_SESSION['username'], $_POST['story_id'], $_POST['comment']);
        header("Location: /story/?id=" . $_POST['story_id']);
    }
    
}