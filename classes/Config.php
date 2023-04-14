<?php

namespace classes;

class Config
{
    private $config;

    public function __construct($info)
    {
        $this->config = include __DIR__ . $info; 
    }

    public function getConfig()
    {
        return $this->config;
    }
}


