<?php

namespace App\Utils;

use App\Repository\NewsRepository;

/**
 * News Manager
 *
 * Manages operations related to news, such as listing, adding, and deleting news articles.
 */
class NewsManager
{
    /**
     * @var NewsRepository The repository for accessing news data.
     * @var CommentManager The manager for handling comments related to news articles.
     */
    private $newsRepository;
    private $commentManager;

    /**
     * Constructor
     *
     * @param NewsRepository $newsRepository The repository for accessing news data.
     * @param CommentManager $commentManager The manager for handling comments related to news articles.
     */
    public function __construct(NewsRepository $newsRepository, CommentManager $commentManager)
    {
        $this->newsRepository = $newsRepository;
        $this->commentManager = $commentManager;
    }

    /**
     * List all news articles.
     *
     * @return array An array of News objects.
     */
    public function listNews()
    {
        return $this->newsRepository->findAll();
    }

    /**
     * Add a new news article.
     *
     * @param string $title The title of the news article.
     * @param string $body The body of the news article.
     * @return int The ID of the newly inserted news article.
     */
    public function addNews(string $title, string $body)
    {
        return $this->newsRepository->insert($title, $body);
    }

    /**
     * Delete a news article by its ID.
     *
     * @param int $id The ID of the news article to delete.
     * @return int The number of affected rows.
     */
    public function deleteNews(int $id)
    {
        return $this->newsRepository->delete($id);
    }
}
