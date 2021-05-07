 <?php
global $conn;

$song_name = getParameter($_POST['song_name'], 'String');
$count_p = getParameter($_POST['count_p'], 'Integer');
$autor = getParameter($_POST['autor'], 'String');
$folders = getParameter($_POST['folders'], 'String');
$notatki = getParameter($_POST['notatki'],'String');
$id = getParameter($_GET['id_s'],'Integer');


$sql = "UPDATE song 
            SET 
                name_song = '$song_name', 
                count = '$count_p', 
                author = '$autor', 
                id_folder = '$folders', 
                note = '$notatki' 
            WHERE id_song = $id;";

if ($conn->query($sql) === TRUE) {
    echo "Dane zostały zaktualizowane<br>";
    echo "<meta http-equiv='refresh' content='1; url=?action=main'>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>