<?php

namespace Repository;

use Factory\CommentFactory;
use Utils\DB;
use Validator\CommentValidator;

class CommentRepository
{
    private $db;
    private $commentFactory;
    private $validator;

    public function __construct(DB $db, CommentFactory $commentFactory, CommentValidator $validator)
    {
        $this->db = $db;
        $this->commentFactory = $commentFactory;
        $this->validator = $validator;
    }

    public function findAll(): array
    {
        $rows = $this->db->select('SELECT * FROM `comment`');
        $commentList = [];
        foreach ($rows as $row) {
            $comment = $this->commentFactory->create();
            $commentList[] = $comment->setId($row['id'])
                                     ->setBody($row['body'])
                                     ->setCreatedAt($row['created_at'])
                                     ->setNewsId($row['news_id']);
        }
        return $commentList;
    }

    public function insert(string $body, int $newsId): int
    {
        // Validate inputs
        $this->validator->validate($body, $newsId);

        // Check if the newsId exists
        if (!$this->newsIdExists($newsId)) {
            throw new \InvalidArgumentException("Invalid News ID: $newsId");
        }

        // Sanitize inputs
        $body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');

        // Use parameterized queries to insert data
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :created_at, :news_id)";
        $params = [
            'body' => $body,
            'created_at' => date('Y-m-d'),
            'news_id' => $newsId
        ];

        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    public function delete(int $id): int
    {
        $sql = "DELETE FROM `comment` WHERE `id`=:id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }

    private function newsIdExists(int $newsId): bool
    {
        $sql = "SELECT COUNT(*) FROM `news` WHERE `id` = :news_id";
        $params = ['news_id' => $newsId];
        $count = $this->db->select($sql, $params);
        
        return $count[0]['COUNT(*)'] > 0;
    }
}
