 <?php
$login = $_GET["login"];

$sql = "delete from accounts where login='$login';";


if ($conn->query($sql) === TRUE) {
  header('Location: users.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>