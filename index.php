<?php

require_once 'setup.php';

use App\Downloader\DownloadMP3;
use App\Token\TokenManager;

session_start();

$method = $_SERVER['REQUEST_METHOD'];

//ROUTING
if ($method === "GET") {
    try {
        $title = "Youtube Download";

        /** @var string $token */
        $token = TokenManager::create();

        $output = $_ENV['OUTPUT_PATH'];
        $files = glob($output . '/*');
        require VIEW . 'layout.phtml';
    } catch (Exception $e) {
        echo htmlspecialchars($e->getMessage());
    }
} elseif ($method === "POST") {
    try {
        DownloadMp3::download($_POST['url']);
    } catch (Exception $e) {
        echo htmlspecialchars($e->getMessage());
    }
}
