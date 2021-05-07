 <?php
 global $conn;

$id = getParameter($_GET["id"], 'String');

$sql = "DELETE FROM song 
        WHERE id_song=$id";


if ($conn->query($sql) === TRUE) {
  echo "Utwór został usunięty<br>";
  echo "<meta http-equiv='refresh' content='1; url=?action=main'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>