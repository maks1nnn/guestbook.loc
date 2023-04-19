<?php


$config = parse_ini_file(__DIR__ . '/config/dbinfo.ini');
require  __DIR__ . '/helpers/printDebugs.php';
PR($config);

$configOne = file(__DIR__ . '/config/dbinfo.php');
PR($configOne);