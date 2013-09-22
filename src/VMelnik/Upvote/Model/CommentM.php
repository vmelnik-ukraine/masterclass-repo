<?php

namespace VMelnik\Upvote\Model;

use VMelnik\Framework\Model;

class CommentM extends Model\BaseM
{

    public function create($username, $storyId, $comment)
    {
        $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
        
        $this->db->query($sql, [
            $username,
            $storyId,
            filter_var($comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ]);
    }

    public function getCommentsCount($storyId)
    {
        $sql = 'SELECT COUNT(*) FROM comment WHERE story_id = ?';
        
        return $this->db->fetchProperty($sql, [$storyId]);
    }

    public function getComments($storyId)
    {
        $sql = 'SELECT * FROM comment WHERE story_id = ?';
        
        return $this->db->fetchAll($sql, [$storyId]);
    }

}
