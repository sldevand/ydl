<?php

require_once 'setup.php';

use App\Downloader\DownloadMP3;
use App\Token\TokenManager;

session_start();

$targetDir = OUTPUT;


$method = $_SERVER['REQUEST_METHOD'];

//ROUTING
if ($method === "GET") {
    try {
        createForm();
    } catch (Exception $e) {
        echo htmlspecialchars($e->getMessage());
    }
} elseif ($method === "POST") {
    try {
        execute($_POST['url']);
    } catch (Exception $e) {
        echo htmlspecialchars($e->getMessage());
    }
}

//CONTROLLER FUNCTIONS
/**
 * @throws \Exception
 */
function createForm()
{
    $title = "Youtube Download";

    /** @var string $token */
    $token = TokenManager::create();
    require VIEW . 'form.phtml';
}

/**
 * @throws Exception
 */
function execute($url)
{

    $result = DownloadMp3::download($url);

    echo $result;
}
