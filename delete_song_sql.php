 <?php
$id = $_GET["id"];

$sql = "delete from song where id_song=$id";


if ($conn->query($sql) === TRUE) {
  echo "Utwór został usunięty<br>";
  echo "<meta http-equiv='refresh' content='1; url=main.php'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>