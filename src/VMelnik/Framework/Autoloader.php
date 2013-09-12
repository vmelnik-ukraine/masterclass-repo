<?php

class Autoloader
{

    protected static $namespacesRoot = [];
    
    public static function register()
    {
        spl_autoload_register(['Autoloader', 'autoload']);
    }

    public static function registerNamespace($name, $rootFolder)
    {
        if (is_dir($rootFolder)) {
            self::$namespacesRoot[$name] = $rootFolder;
            return true;
        }
        
        return false;
    }

    public static function autoload($className)
    {
        $namespacesParts = explode('\\', $className);
        $class = preg_replace('/_/', DIRECTORY_SEPARATOR, array_pop($namespacesParts));
        $namespace = array_shift($namespacesParts);
        
        if (isset(self::$namespacesRoot[$namespace])) {
            $path = self::$namespacesRoot[$namespace] . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $namespacesParts);
            require_once $path . DIRECTORY_SEPARATOR . $class . '.php';
        }
    }
    
    protected function __construct() {}

}