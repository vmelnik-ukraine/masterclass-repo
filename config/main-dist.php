<?php

return array(
    'database' => array(
        'user' => '',
        'pass' => '',
        'host' => '',
        'name' => '',
    ),
    'routes' => array(
        '' => ['VMelnik\Upvote\Controller\Index', 'index'],
        'story' => ['VMelnik\Upvote\Model\Story', 'index'],
        'story/create' => ['VMelnik\Upvote\Model\Story', 'create'],
        'comment/create' => ['VMelnik\Upvote\Model\Comment', 'create'],
        'user/create' => ['VMelnik\Upvote\Model\User', 'create'],
        'user/account' => ['VMelnik\Upvote\Model\User', 'account'],
        'user/login' => ['VMelnik\Upvote\Model\User', 'login'],
        'user/logout' => ['VMelnik\Upvote\Model\User', 'logout'],
    ),
);