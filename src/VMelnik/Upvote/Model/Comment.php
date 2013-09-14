<?php

namespace VMelnik\Upvote\Model;

class Comment
{

    protected $db;

    public function __construct(array $config = [])
    {
        $dbconfig = $config['database'];
        $dsn = 'mysql:host=' . $dbconfig['host'] . ';dbname=' . $dbconfig['name'];
        $this->db = new \PDO($dsn, $dbconfig['user'], $dbconfig['pass']);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function create($username, $storyId, $comment)
    {
        $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            $username,
            $storyId,
            filter_var($comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ));
    }

    public function getCommentsCount($storyId)
    {
        $sql = 'SELECT COUNT(*) FROM comment WHERE story_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$storyId]);

        return $stmt->fetch(\PDO::FETCH_COLUMN);
    }

    public function getComments($storyId)
    {
        $sql = 'SELECT * FROM comment WHERE story_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$storyId]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
