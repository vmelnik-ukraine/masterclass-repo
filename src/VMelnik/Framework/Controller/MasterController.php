<?php

namespace VMelnik\Framework\Controller;

class MasterController {
    
    private $config;
    
    public function __construct($config) {
        $this->_setupConfig($config);
    }
    
    public function execute() {
        $call = $this->_determineControllers();
        $class = $call['controller'];
        $method = $call['action'];
        $o = new $class($this->config);
        return $o->$method();
    }
    
    private function _determineControllers()
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
    
    private function _setupConfig($config) {
        $this->config = $config;
    }
    
}