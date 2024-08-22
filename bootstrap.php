<?php

define('ROOT', __DIR__);

// Load all necessary files
require_once(ROOT . '/interface/ContentInterface.php');
require_once(ROOT . '/utils/DB.php');
require_once(ROOT . '/utils/CommentManager.php');
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/class/Comment.php');
require_once(ROOT . '/class/News.php');
require_once(ROOT . '/factory/CommentFactory.php');
require_once(ROOT . '/factory/NewsFactory.php');
require_once(ROOT . '/repository/CommentRepository.php');
require_once(ROOT . '/repository/NewsRepository.php');
require_once(ROOT . '/validator/CommentValidator.php');
require_once(ROOT . '/validator/NewsValidator.php');

// Import Namespaced Classes
use Utils\DB;
use Utils\CommentManager;
use Utils\NewsManager;
use Factory\CommentFactory;
use Factory\NewsFactory;
use Repository\CommentRepository;
use Repository\NewsRepository;
use Validator\CommentValidator;
use Validator\NewsValidator;

// Initialize Dependencies
function bootstrap()
{
    $db = DB::getInstance();
    
    $commentFactory = new CommentFactory();
    $newsFactory = new NewsFactory();
    
    $commentValidator = new CommentValidator($db);
    $newsValidator = new NewsValidator();
    
    $commentRepository = new CommentRepository($db, $commentFactory, $commentValidator);
    $newsRepository = new NewsRepository($db, $newsFactory, $newsValidator);
    
    $commentManager = new CommentManager($commentRepository);
    $newsManager = new NewsManager($newsRepository, $commentManager);
    
    return [$newsManager, $commentManager];
}