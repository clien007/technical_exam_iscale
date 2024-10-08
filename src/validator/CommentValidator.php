<?php

namespace App\Validator;
use App\Utils\DB;

class CommentValidator
{

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Validates the body of a comment and its associated news ID.
     *
     * @param string $body
     * @param int $newsId
     * @return void
     * @throws \InvalidArgumentException
     */
    public function validate(string $body, int $newsId): void
    {
        $this->validateBody($body);
        $this->validateNewsId($newsId);
        $this->newsIdExists($newsId);
    }

    /**
     * Validates the body of the comment.
     *
     * @param string $body
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateBody(string $body): void
    {
        if (empty($body)) {
            throw new \InvalidArgumentException('Body must not be empty.');
        }
    }

    /**
     * Validates the news ID associated with the comment.
     *
     * @param int $newsId
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateNewsId(int $newsId): void
    {
        if ($newsId <= 0) {
            throw new \InvalidArgumentException('News ID must be a positive integer.');
        }
    }

    /**
     * Validates the news ID if exists in Database.
     *
     * @param int $newsId
     * @return void
     * @throws \InvalidArgumentException
     */

     private function newsIdExists(int $newsId): void
     {
         $sql = "SELECT COUNT(*) FROM `news` WHERE `id` = :news_id";
         $params = ['news_id' => $newsId];
         $count = $this->db->select($sql, $params);

        if($count[0]['COUNT(*)'] <= 0){
            throw new \InvalidArgumentException("Invalid News ID: $newsId");
        }
     }
}
