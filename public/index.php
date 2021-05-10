<?php
include '../config/config.php';
include CLASS_FOLDER.'User.php';
require_once ROOT_FOLDER.'inc/common_functions.php';
session_start();

$action = $_GET['action'] ? $_GET['action'] : 'authorization';

$oUser = new User();

global $conn;
$conn = new mysqli(DB_SERVER, DB_USER, DB_PAS, DB_NAME);

//$query = $_GET['action'] ? $_GET['action'] : 'section';

$action = $oUser->isLogin() ? $action : 'authorization';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include ROOT_FOLDER.$action.'.php';
?>