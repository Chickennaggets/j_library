 <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$name_fold = $_POST['name_fold'];
$notes = $_POST['note'];


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into folder(name_folder, note) values ('$name_fold', '$notes');";


if ($conn->query($sql) === TRUE) {
  echo "Teczka dodana<br>";
  echo "<meta http-equiv='refresh' content='1; url=folders.php'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br><br>Możliwe że taka teczka już istnieje.";
  echo "<br><a href='add_fold.php'>Cofnij</a>";
}

$conn->close();
?>