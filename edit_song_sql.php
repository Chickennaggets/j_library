 <?php

$song_name = $_POST['song_name'];
$count_p = $_POST['count_p'];
$autor = $_POST['autor'];
$folders = $_POST['folders'];
$notatki = $_POST['notatki'];
$id = $_GET['id_s'];


$sql = "update song set name_song = '$song_name', count = '$count_p', author = '$autor', id_folder = '$folders', note = '$notatki' where id_song = $id;";

if ($conn->query($sql) === TRUE) {
  echo "Dane zostały zaktualizowane<br>";
  echo "<meta http-equiv='refresh' content='1; url=main.php'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>