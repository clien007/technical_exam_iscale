<?php

namespace App\Utils;

use App\Utils\DB;
use App\Utils\CommentManager;
use App\Repository\NewsRepository;

class NewsManager
{
    private $newsRepository;
    private $commentManager;

    public function __construct(NewsRepository $newsRepository, CommentManager $commentManager)
    {
        $this->newsRepository = $newsRepository;
        $this->commentManager = $commentManager;
    }

    public function listNews(): array
    {
        return $this->newsRepository->findAll();
    }

    public function addNews(string $title, string $body): int
    {
        return $this->newsRepository->insert($title, $body);
    }

    public function deleteNews(int $id): int
    {
        // Delete related comments first
        $comments = $this->commentManager->listComments();
        foreach ($comments as $comment) {
            if ($comment->getNewsId() == $id) {
                $this->commentManager->deleteComment($comment->getId());
            }
        }

        return $this->newsRepository->delete($id);
    }
}