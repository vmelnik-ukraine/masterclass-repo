<?php

namespace VMelnik\Upvote\Model;

use VMelnik\Framework\Model;

class StoryM extends Model\BaseM
{

    public function getOne($storyId)
    {
        $sql = 'SELECT * FROM story WHERE id = ?';
        
        return $this->db->fetchOne($sql, [$storyId]);
    }

    public function getStories()
    {
        $sql = 'SELECT * FROM story ORDER BY created_on DESC';
        
        return $this->db->fetchAll($sql);
    }

    public function addStory($headline, $url, $username)
    {
        $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';
        
        $this->db->query($sql, [
            $headline,
            $url,
            $username,
        ]);
        
        return $this->db->getLastInsertId();
    }

}