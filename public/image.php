<?php
require_once("../include/bittorrent.php");
dbconn();

$action = $_GET['action'] ?? '';
$imagehash = $_GET['imagehash'] ?? '';

if ($action !== 'regimage') {
    http_response_code(404);
    exit('Invalid captcha action');
}

$driver = captcha_manager()->driver('image');

if (!method_exists($driver, 'outputImage')) {
    http_response_code(404);
    exit('Captcha driver does not support image rendering');
}

$driver->outputImage($imagehash);

?>
