<?php
include '../config/config.php';

session_start();

$action = $_GET['action'] ? $_GET['action'] : 'main';

$conn = new mysqli(DB_SERVER, DB_USER, DB_PAS, DB_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

include ROOT_FOLDER.$action.'.php';


?>