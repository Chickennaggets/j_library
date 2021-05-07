 <?php
 global $conn;
$name_folder = getParameter($_GET["name_folder"], 'String');

$sql = "DELETE FROM folder 
        WHERE name_folder='$name_folder';";

if ($conn->query($sql) === TRUE) {
  header('Location: folders.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br><br><br>Nie da się usunąć teczki w której są utwory ! Najperw trzeba pousuwać utwory znajdujące się w tej teczce, albo przenieść utwory w inne teczki.<br><br>";
  echo "<a href='folders.php'>Cofnij</a>";
}
?>