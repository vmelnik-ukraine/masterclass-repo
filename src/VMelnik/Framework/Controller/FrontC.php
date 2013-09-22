<?php

namespace VMelnik\Framework\Controller;

use VMelnik\Framework\DI;

class FrontC {
    
    private $config;
    
    public function __construct($config) {
        $this->setupConfig($config);
    }
    
    public function execute() {
        $call = $this->determineController();
        $identifier = $call['controller'];
        $method = $call['action'];
        
        $dic = new DI\DIC($this->config['dic']);
        
        try {
            $o = $dic->get($identifier);
        } catch (DI\UnregisteredIdentifierE $e) {
            // log error. show 404?
            exit('404 Page doesn\'t exist');
        }
        
        
        return $o->$method();
    }
    
    protected function determineController()
    {
        if (isset($_SERVER['REDIRECT_BASE'])) {
            $rb = $_SERVER['REDIRECT_BASE'];
        } else {
            $rb = '';
        }
        
        $ruri = $_SERVER['REQUEST_URI'];
        $path = str_replace($rb, '', $ruri);
        $return = array();
        
        foreach($this->config['routes'] as $k => $v) {
            $matches = array();
            $pattern = '$' . $k . '$';
            if(preg_match($pattern, $path, $matches))
            {
                $controller_details = $v;
                $return = array(
                    'controller' => $controller_details[0],
                    'action' => $controller_details[1],
                );
            }
        }
        
        return $return;
    }
    
    protected function setupConfig($config) {
        $this->config = $config;
    }
    
}