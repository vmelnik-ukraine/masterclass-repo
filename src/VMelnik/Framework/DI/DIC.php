<?php

namespace VMelnik\Framework\DI;

class DIC
{

    protected $config;
    protected $instances;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->instances['dic'] = $this;
    }

    public function get($identifier)
    {
        if (!isset($this->instances[$identifier])) {
            if (!isset($this->config[$identifier])) {
                throw new UnregisteredIdentifierE("Unknown identifier $identifier");
            }

            $config = $this->config[$identifier];
            $className = $config['class'];
            $deps = [];

            if (!empty($config['deps'])) {
                foreach ($config['deps'] as $dependency) {
                    if (isset($dependency['type']) && $dependency['type'] == 'dep') {
                        $deps[] = $this->get($dependency['data']);
                    } else {
                        $deps[] = $dependency;
                    }
                }
            }
            
            if (empty($deps)) {
                $this->instances[$identifier] = new $className();
            } else {
                $refl = new \ReflectionClass($className);
                $this->instances[$identifier] = $refl->newInstanceArgs($deps);
            }
        }

        return $this->instances[$identifier];
    }

}
