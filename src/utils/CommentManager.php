<?php

namespace App\Utils;

use App\Utils\DB;
use App\Repository\CommentRepository;

class CommentManager
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function listComments(): array
    {
        return $this->commentRepository->findAll();
    }

    public function addCommentForNews(string $body, int $newsId): int
    {
        return $this->commentRepository->insert($body, $newsId);
    }

    public function deleteComment(int $id): int
    {
        return $this->commentRepository->delete($id);
    }
}
