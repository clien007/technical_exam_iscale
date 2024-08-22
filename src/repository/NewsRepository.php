<?php

namespace App\Repository;

use App\Factory\NewsFactory;
use App\Utils\DB;
use App\Validator\NewsValidator;

class NewsRepository
{
    private $db;
    private $newsFactory;
    private $validator;

    public function __construct(DB $db, NewsFactory $newsFactory, NewsValidator $validator)
    {
        $this->db = $db;
        $this->newsFactory = $newsFactory;
        $this->validator = $validator;
    }

    public function findAll(): array
    {
        $rows = $this->db->select('SELECT * FROM `news`');
        $newsList = [];
        foreach ($rows as $row) {
            $news = $this->newsFactory->create();
            $newsList[] = $news->setId($row['id'])
                               ->setTitle($row['title'])
                               ->setBody($row['body'])
                               ->setCreatedAt($row['created_at']);
        }
        return $newsList;
    }

    public function insert(string $title, string $body): int
    {
        // Validate inputs
        $this->validator->validate($title, $body);

        // Sanitize inputs
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');

        // Use parameterized queries to insert data
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(:title, :body, :created_at)";
        $params = [
            'title' => $title,
            'body' => $body,
            'created_at' => date('Y-m-d')
        ];

        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    public function delete(int $id): int
    {
        $sql = "DELETE FROM `news` WHERE `id`=:id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }
}
