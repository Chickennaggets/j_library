 <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$name_folder = $_GET["name_folder"];


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from folder where name_folder='$name_folder';";

if ($conn->query($sql) === TRUE) {
  header('Location: folders.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br><br><br>Nie da się usunąć teczki w której są utwory ! Najperw trzeba pousuwać utwory znajdujące się w tej teczce, albo przenieść utwory w inne teczki.<br><br>";
  echo "<a href='folders.php'>Cofnij</a>";
}

$conn->close();
?>