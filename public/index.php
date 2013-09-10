<?php

session_start();

$config = require_once('../config/main.php');
require_once '../src/VMelnik/Framework/Controller/MasterController.php';

require_once '../src/VMelnik/Upvote/Model/Comment.php';
require_once '../src/VMelnik/Upvote/Model/User.php';
require_once '../src/VMelnik/Upvote/Model/Story.php';
require_once '../src/VMelnik/Upvote/Controller/Index.php';

$framework = new MasterController($config);
echo $framework->execute();