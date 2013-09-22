<?php

namespace VMelnik\Framework\DB;

use VMelnik\Framework\DB\Interfaces;

class PDOConnection implements Interfaces\ConnectionI
{

    protected $db;

    public function __construct($dsn, $user, $pass = '')
    {
        $this->db = new \PDO($dsn, $user, $pass);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function fetchOne($sql, array $args = array())
    {
        return $this->query($sql, $args)->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function fetchProperty($sql, array $args = array())
    {
        return $this->query($sql, $args)->fetchColumn();
    }

    public function fetchAll($sql, array $args = array())
    {
        return $this->query($sql, $args)->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * Perform a query
     * 
     * @param string $sql
     * @param array $args
     * 
     * @return \PDOStatement
     */
    public function query($sql, array $args = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args);
        
        return $stmt;
    }

}