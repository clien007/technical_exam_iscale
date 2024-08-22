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
    
    $commentValidator = new CommentValidator();
    $newsValidator = new NewsValidator();
    
    $commentRepository = new CommentRepository($db, $commentFactory, $commentValidator);
    $newsRepository = new NewsRepository($db, $newsFactory, $newsValidator);
    
    $commentManager = new CommentManager($commentRepository);
    $newsManager = new NewsManager($newsRepository, $commentManager);
    
    return [$newsManager, $commentManager];
}

// Run Application
list($newsManager, $commentManager) = bootstrap();

// List and display all news articles with their comments
foreach ($newsManager->listNews() as $news) {
    echo "############ NEWS " . $news->getTitle() . " ############\n";
    echo $news->getBody() . "\n";
    
    // Fetch comments for the current news article
    foreach ($commentManager->listComments() as $comment) {
        if ($comment->getNewsId() == $news->getId()) {
            echo "Comment " . $comment->getId() . " : " . $comment->getBody() . "\n";
        }
    }
}

// try{
//     $newsID = $newsManager->addNews('News 6','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales tortor a elit tincidunt feugiat. Pellentesque a nisl dui. Fusce fringilla, libero et tristique rhoncus, justo neque fermentum lacus, sit amet placerat leo lectus et lectus. Nulla in pulvinar libero. Cras consequat varius arcu fermentum vulputate. Cras sem ante, varius rutrum suscipit ut, tempus sed elit. Donec condimentum consequat vehicula.');
//     $commentManager->addCommentForNews('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales tortor a elit tincidunt feugiat. Pellente',$newsID);
//     echo "News and Comment successfully added";
// }catch (Exception $e){
//     echo "Error: " . $e->getMessage() . "\n";
// }
