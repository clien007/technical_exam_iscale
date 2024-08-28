<?php

namespace App\Utils;

use App\Repository\CommentRepository;

/**
 * Comment Manager
 *
 * Manages operations related to comments, such as listing, adding, and deleting comments.
 */
class CommentManager
{
    /**
     * @var CommentRepository The repository for accessing comment data.
     */
    private $commentRepository;

    /**
     * Constructor
     *
     * @param CommentRepository $commentRepository The repository for accessing comment data.
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * List all comments.
     *
     * @return array An array of Comment objects.
     */
    public function listComments()
    {
        return $this->commentRepository->findAll();
    }

    /**
     * Add a new comment to a specific news article.
     *
     * @param string $body The content of the comment.
     * @param int $newsId The ID of the news article the comment is associated with.
     * @return int The ID of the newly inserted comment.
     */
    public function addComment(string $body, int $newsId)
    {
        return $this->commentRepository->insert($body, $newsId);
    }

    /**
     * Delete a comment by its ID.
     *
     * @param int $id The ID of the comment to delete.
     * @return int The number of affected rows.
     */
    public function deleteComment(int $id)
    {
        return $this->commentRepository->delete($id);
    }

    /**
     * Get comments by the associated news ID.
     *
     * @param int $newsId The ID of the news article.
     * @return array An array of Comment objects.
     */
    public function getCommentsByNewsId(int $newsId)
    {
        return $this->commentRepository->findByNewsId($newsId);
    }
}
