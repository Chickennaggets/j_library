 <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$login = $_GET["login"];


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from accounts where login='$login';";


if ($conn->query($sql) === TRUE) {
  header('Location: users.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>