<?php

namespace VMelnik\Upvote\Model;

class Story
{

    protected $db;

    public function __construct(array $config = [])
    {
        $dbconfig = $config['database'];
        $dsn = 'mysql:host=' . $dbconfig['host'] . ';dbname=' . $dbconfig['name'];
        $this->db = new \PDO($dsn, $dbconfig['user'], $dbconfig['pass']);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getOne($storyId)
    {
        $sql = 'SELECT * FROM story WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$storyId]);

        return $stmt->rowCount() > 0 ? $stmt->fetch(\PDO::FETCH_ASSOC) : null;
    }

    public function getStories()
    {
        $sql = 'SELECT * FROM story ORDER BY created_on DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addStory($headline, $url, $username)
    {
        $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $headline,
            $url,
            $username,
        ]);

        return $this->db->lastInsertId();
    }

}