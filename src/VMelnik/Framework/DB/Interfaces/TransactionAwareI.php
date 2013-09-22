<?php

namespace VMelnik\Framework\DB\Interfaces;

interface TransactionAwareI {
    
    /**
     * Begin a database transaction
     */
    public function beginTransaction();
    
    /**
     * Commit a database transaction
     */
    public function commit();
    
    /**
     * Roll back a database transaction
     */
    public function rollback();
    
}