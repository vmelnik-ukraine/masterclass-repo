<?php

namespace VMelnik\Upvote\Model;

use VMelnik\Framework\Model;

class UserM extends Model\BaseM
{

    public function authUser($username, $pwd)
    {
        $authRes = false;
        $sql = 'SELECT * FROM user WHERE username = ? AND password = ?';
        
        $user = $this->db->fetchOne($sql, [$username, md5($username . $pwd)]);

        if ($user) {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $authRes = $_SESSION['AUTHENTICATED'] = true;
        }

        return $authRes;
    }

    public function getUser($username)
    {
        $dsql = 'SELECT * FROM user WHERE username = ?';
        
        return $this->db->fetchOne($dsql, [$username]);
    }

    public function changePassword($username, $newPwd)
    {
        $sql = 'UPDATE user SET password = ? WHERE username = ?';
        
        return $this->db->query($sql, [
            md5($username . $newPwd),
            $username,
        ]);
    }

    public function createUser($username, $email, $pwd)
    {
        $sql = 'INSERT INTO user (username, email, password) VALUES (?, ?, ?)';
        
        return $this->db->query($sql, [
            $username,
            $email,
            md5($username . $pwd),
        ]);
    }

    public function isUserExists($username)
    {
        $sql = 'SELECT * FROM user WHERE username = ?';
        $user = $this->db->fetchOne($sql, [$username]);

        return !empty($user);
    }

}
