 <?php
$name_fold = $_POST['name_fold'];
$notes = $_POST['note'];

$sql = "insert into folder(name_folder, note) values ('$name_fold', '$notes');";


if ($conn->query($sql) === TRUE) {
  echo "Teczka dodana<br>";
  echo "<meta http-equiv='refresh' content='1; url=folders.php'>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br><br>Możliwe że taka teczka już istnieje.";
  echo "<br><a href='add_fold.php'>Cofnij</a>";
}
?>