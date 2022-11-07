<?php

use VickyTsang\Divido\loadConfig;
require 'vendor/autoload.php';

// load config from json file
$jsonConfig = new loadConfig(['fixtures/config.json']);
echo "environment: ";
echo $jsonConfig->get('environment');
echo "<br>";
echo "cache: ";
print_r($jsonConfig->get('cache'));
echo "<br>";

// load config from ini file
$iniConfig = new loadConfig(['fixtures/config.local.ini']);
echo "environment: ";
echo $iniConfig->get('environment');
echo "<br>";
echo "cache: ";
print_r($iniConfig->get('cache'));
echo "<br>";

// merge config
$jsonConfig->merge($iniConfig);
echo "environment: ";
echo $iniConfig->get('environment');
echo "<br>";
echo "cache: ";
print_r($iniConfig->get('cache'));
echo "<br>";

// load config from multiple file
$multiConfig = new loadConfig(['fixtures/config.json', 'fixtures/config.local.ini']);
echo "environment: ";
echo $iniConfig->get('environment');
echo "<br>";
echo "cache: ";
print_r($iniConfig->get('cache'));
echo "<br>";
?>