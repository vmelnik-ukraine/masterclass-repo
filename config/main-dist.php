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
        'story' => ['VMelnik\Upvote\Controller\Story', 'index'],
        'story/create' => ['VMelnik\Upvote\Controller\Story', 'create'],
        'comment/create' => ['VMelnik\Upvote\Controller\Comment', 'create'],
        'user/create' => ['VMelnik\Upvote\Controller\User', 'create'],
        'user/account' => ['VMelnik\Upvote\Controller\User', 'account'],
        'user/login' => ['VMelnik\Upvote\Controller\User', 'login'],
        'user/logout' => ['VMelnik\Upvote\Controller\User', 'logout'],
    ),
);