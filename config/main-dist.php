<?php

return array(
    'routes' => [
        '' => ['index.c', 'index'],
        'story' => ['story.c', 'index'],
        'story/create' => ['story.c', 'create'],
        'comment/create' => ['comment.c', 'create'],
        'user/create' => ['user.c', 'create'],
        'user/account' => ['user.c', 'account'],
        'user/login' => ['user.c', 'login'],
        'user/logout' => ['user.c', 'logout'],
    ],
    'dic' => [
        'story.c' => [
            'class' => 'VMelnik\Upvote\Controller\StoryC',
            'deps' => [
                ['data' => 'dic', 'type' => 'dep'],
            ],
        ],
        'comment.c' => [
            'class' => 'VMelnik\Upvote\Controller\CommentC',
            'deps' => [
                ['data' => 'dic', 'type' => 'dep'],
            ],
        ],
        'user.c' => [
            'class' => 'VMelnik\Upvote\Controller\UserC',
            'deps' => [
                ['data' => 'dic', 'type' => 'dep'],
            ],
        ],
        'index.c' => [
            'class' => 'VMelnik\Upvote\Controller\IndexC',
            'deps' => [
                ['data' => 'dic', 'type' => 'dep'],
            ],
        ],
        'story.m' => [
            'class' => 'VMelnik\Upvote\Model\StoryM',
            'deps' => [
                ['data' => 'pdo.db', 'type' => 'dep'],
            ],
        ],
        'comment.m' => [
            'class' => 'VMelnik\Upvote\Model\CommentM',
            'deps' => [
                ['data' => 'pdo.db', 'type' => 'dep'],
            ],
        ],
        'user.m' => [
            'class' => 'VMelnik\Upvote\Model\UserM',
            'deps' => [
                ['data' => 'pdo.db', 'type' => 'dep'],
            ],
        ],
        'pdo.db' => [
            'class' => 'VMelnik\Framework\DB\PDOConnection',
            'deps' => [
                'mysql:host=;dbname=upvote;',
                'vmelnik',
                'not-so-secret-pwd',
            ],
        ]
    ],
);