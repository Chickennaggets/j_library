<?php
include '../config/config.php';
include CLASS_FOLDER.'User.php';
include CLASS_FOLDER.'Get.php';
include CLASS_FOLDER.'Folder.php';
include CLASS_FOLDER.'Song.php';
require_once ROOT_FOLDER.'inc/common_functions.php';

session_start();

$oUser = new User();

global $conn;
$conn = new mysqli(DB_SERVER, DB_USER, DB_PAS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$section = Get::get('section', 'info', Get::TYPE_STR);
//$section = $oUser->isLogin() ? $section : 'authorization';

if(!faceControle($section)){
    echo 'No way';
    $section='error?text=No_way';
}

if (isset($_GET['ajax'])) {
    include_once ROOT_FOLDER.$section.'.php';
} else {
    include_once ROOT_FOLDER.'page.php';
}

