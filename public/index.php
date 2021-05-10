<?php
include '../config/config.php';
require_once ROOT_FOLDER.'inc/common_functions.php';
session_start();

$action = $_GET['action'] ? $_GET['action'] : 'authorization';

global $conn;
$conn = new mysqli(DB_SERVER, DB_USER, DB_PAS, DB_NAME);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include ROOT_FOLDER.$action.'.php';
?>