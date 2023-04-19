<?php

namespace vendor;

use Exception;

class Config
{
    private $configData;

    public function __construct($configFile)
    {
        if (!file_exists($configFile)) {
            throw new Exception('Config file not found');
        }

        $this->configData = parse_ini_file($configFile);
    }

    public function getConfig()
    {
        return $this->configData;
    }

    public function get($key)
    {

        if (!isset($this->configData[$key])) {
            throw new Exception('Key not found in config file');
        }

        return $this->configData[$key];
    }
}
