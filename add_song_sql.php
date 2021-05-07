 <?php
 global $conn;

$song_name = getParameter($_POST['song_name'], 'String');
$count_p = getParameter($_POST['count_p'], 'Integer');
$autor = getParameter($_POST['autor'], 'String');
$folders = getParameter($_POST['folders'],'String');
$notatki = getParameter($_POST['notatki'], 'String');

$sql = "INSERT INTO song(name_song, count, author, id_folder, note)
            values ('$song_name', $count_p, '$autor', $folders, '$notatki');";

if ($conn->query($sql) === TRUE) {
    echo "Nowy utwór został dodany<br>";
    echo "<meta http-equiv='refresh' content='1; url=main.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>