<?php

namespace VMelnik\Framework\DB\Interfaces;

interface ConnectionI {
    
    /**
     * Fetch an associative array for one result
     * 
     * @param string $sql
     * @param array $args
     * 
     * @return array
     */
    public function fetchOne($sql, array $args = []);
    
    /**
     * Fetch one property from record
     * 
     * @param string $sql
     * @param array $args
     * 
     * @return mixed One of scalar types
     */
    public function fetchProperty($sql, array $args = []);
    
    /**
     * Fetch an array of associative arrays of all results
     * 
     * @param string $sql
     * @param array $args
     * 
     * @return array
     */
    public function fetchAll($sql, array $args = []);
    
    /**
     * Return last insert id for connection
     */
    public function getLastInsertId();
    
    /**
     * Perform a prepared query
     * 
     * @param string $sql
     * @param array $args
     */
    public function query($sql, array $args = []);
    
}
