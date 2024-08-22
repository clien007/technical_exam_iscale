<?php
define('ROOT', __DIR__);

// Load interfaces and utilities
require_once(ROOT . '/interface/ContentInterface.php');
require_once(ROOT . '/class/Comment.php');
require_once(ROOT . '/class/News.php');
require_once(ROOT . '/utils/DB.php');
require_once(ROOT . '/utils/CommentManager.php');
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/factory/CommentFactory.php');
require_once(ROOT . '/factory/NewsFactory.php');

// Import namespaced classes
use Utils\DB;
use Utils\CommentManager;
use Utils\NewsManager;
use Factory\CommentFactory;
use Factory\NewsFactory;

// Initialize necessary components
$db = DB::getInstance();
$commentFactory = new CommentFactory();
$newsFactory = new NewsFactory();
$commentManager = CommentManager::getInstance($db, $commentFactory);
$newsManager = NewsManager::getInstance($db, $newsFactory, $commentManager);
