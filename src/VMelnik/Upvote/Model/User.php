<?php

namespace VMelnik\Upvote\Model;

class User
{

    protected $db;

    public function __construct(array $config = [])
    {
        $dbconfig = $config['database'];
        $dsn = 'mysql:host=' . $dbconfig['host'] . ';dbname=' . $dbconfig['name'];
        $this->db = new \PDO($dsn, $dbconfig['user'], $dbconfig['pass']);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function authUser($username, $pwd)
    {
        $authRes = false;
        $pwd = md5($username . $pwd);
        $sql = 'SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($username, $pwd));

        if ($stmt->rowCount() > 0) {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $authRes = $_SESSION['AUTHENTICATED'] = true;
        }

        return $authRes;
    }

    public function getUser($username)
    {
        $dsql = 'SELECT * FROM user WHERE username = ?';
        $stmt = $this->db->prepare($dsql);
        $stmt->execute([$username]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function changePassword($username, $newPwd)
    {
        $sql = 'UPDATE user SET password = ? WHERE username = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            md5($username . $newPwd),
            $username,
        ]);
    }

    public function createUser($username, $email, $pwd)
    {
        $pwd = md5($username . $pwd);
        $sql = 'INSERT INTO user (username, email, password) VALUES (?, ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $username,
            $email,
            $pwd,
        ]);
    }

    public function isUserExists($username)
    {
        $sql = 'SELECT * FROM user WHERE username = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->rowCount() > 0;
    }

}
