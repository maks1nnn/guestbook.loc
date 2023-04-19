<?php

namespace vendor;

class Config
{
    private $config;

    public function __construct()
    {
        $this->config = include  '../config/dbinfo.php'; 
    }

    public function getConfig()
    {
        return $this->config;
    }
}


