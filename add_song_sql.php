 <?php
$song_name = $_POST['song_name'];
$count_p = $_POST['count_p'];
$autor = $_POST['autor'];
$folders = $_POST['folders'];
$notatki = $_POST['notatki'];

$sql = "insert into song(name_song, count, author, id_folder, note) values ('$song_name', $count_p, '$autor', $folders, '$notatki');";


if ($conn->query($sql) === TRUE) {
  echo "Nowy utwór został dodany<br>";
  echo "<meta http-equiv='refresh' content='1; url=main.php'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>