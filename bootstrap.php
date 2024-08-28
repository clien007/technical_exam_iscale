<?php
// bootstrap.php

use App\Utils\DB;
use App\Factory\CommentFactory;
use App\Factory\NewsFactory;
use App\Validator\CommentValidator;
use App\Validator\NewsValidator;
use App\Repository\CommentRepository;
use App\Repository\NewsRepository;
use App\Utils\CommentManager;
use App\Utils\NewsManager;

/**
 * Initialize Dependencies
 *
 * Sets up the necessary dependencies for the application.
 *
 * @return array An array containing instances of NewsManager and CommentManager.
 */

function initializeDependencies()
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
