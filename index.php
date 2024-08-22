<?php
// Load the autoloader
require_once __DIR__ . '/autoload.php';

// Initialize dependencies
require_once __DIR__ . '/bootstrap.php';

list($newsManager, $commentManager) = initializeDependencies();

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

// Add News and Comment
// try{
//     $newsID = $newsManager->addNews('News 6','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales tortor a elit tincidunt feugiat. Pellentesque a nisl dui. Fusce fringilla, libero et tristique rhoncus, justo neque fermentum lacus, sit amet placerat leo lectus et lectus. Nulla in pulvinar libero. Cras consequat varius arcu fermentum vulputate. Cras sem ante, varius rutrum suscipit ut, tempus sed elit. Donec condimentum consequat vehicula.');
//     $commentManager->addCommentForNews('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales tortor a elit tincidunt feugiat. Pellente',$newsID);
//     echo "News and Comment successfully added";
// }catch (Exception $e){
//     echo "Error: " . $e->getMessage() . "\n";
// }


// Add Comment
// try{
//     $commentManager->addCommentForNews('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sodales tortor a elit tincidunt feugiat. Pellente',14);
//     echo "Comment successfully added";
// }catch (Exception $e){
//     echo "Error: " . $e->getMessage() . "\n";
// }
