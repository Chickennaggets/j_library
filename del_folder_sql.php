 <?php
$name_folder = $_GET["name_folder"];

$sql = "delete from folder where name_folder='$name_folder';";

if ($conn->query($sql) === TRUE) {
  header('Location: folders.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br><br><br>Nie da się usunąć teczki w której są utwory ! Najperw trzeba pousuwać utwory znajdujące się w tej teczce, albo przenieść utwory w inne teczki.<br><br>";
  echo "<a href='folders.php'>Cofnij</a>";
}
?>