<?php

namespace VMelnik\Framework\Model;

use VMelnik\Framework\DB\Interfaces;

class BaseM {
    
    /**
     * DB connection
     * 
     * @var Interfaces\Connection
     */
    protected $db;
    
    public function __construct(Interfaces\ConnectionI $conn)
    {
        $this->db = $conn;
    }
    
}