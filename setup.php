<?php
ini_set('display_errors', '1');
define('ROOT',__DIR__.'/');
define('SRC',ROOT.'src/');
define('VIEW',SRC.'view/');

require_once ROOT."vendor/autoload.php";

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');