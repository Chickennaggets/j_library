 <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$id = $_GET["id"];


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from song where id_song=$id";


if ($conn->query($sql) === TRUE) {
  echo "Utwór został usunięty<br>";
  echo "<meta http-equiv='refresh' content='1; url=main.php'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>