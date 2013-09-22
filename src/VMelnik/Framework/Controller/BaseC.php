<?php

namespace VMelnik\Framework\Controller;

use VMelnik\Framework\DI;

class BaseC {
    
    /**
     * Dependency injection container
     * 
     * @var DIC
     */
    protected $dic;
    
    public function __construct(DI\DIC $dic) {
        $this->dic = $dic;
    }
    
    public function get($identifier) {
        try {
            return $this->dic->get($identifier);
        } catch (DI\UnregisteredIdentifierE $e) {
            // need redirect here?
            error_log(sprintf('[%s] %s', __CLASS__, $e->getMessage()));
            exit('Page is unavailable, please try again later');
        }
    }
    
}