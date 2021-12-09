<?php

namespace App\Fram\Utils;

class DIC
{
    private array $registry = [];
    private array $factories = [];
    private array $instances = [];

    /**
     * @param $key
     * @param callable $resolver
     */
    public function set($key, callable $resolver)
    {
        $this->registry[$key] = $resolver;
    }

    /**
     * @param $key
     * @param callable $resolver
     */
    public function setFactory($key, callable $resolver)
    {
        $this->factories[$key] = $resolver;
    }

    /**
     * @throws \ReflectionException
     */
    public function setInstance($instance)
    {
        $reflected = new \ReflectionClass($instance);
        $this->instances[$reflected->getName()] = $instance;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if(isset($this->factories[$key])) {
            return $this->factories[$key]();
        }
        if(isset($this->instances[$key])) {
            $this->instances[$key] = $this->registry[$key]();
        }
        return $this->instances[$key];
    }
}