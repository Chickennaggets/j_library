 <?php
global $conn;

$parameter = getParameter($_GET['parameter'], 'String');
$word = getParameter($_GET['word'], 'String');

$sql = "SELECT id_song, name_song, count, author, folder.name_folder
                    FROM song 
                        LEFT JOIN folder ON song.id_folder = folder.id_folder
                            WHERE name_song LIKE '%".$word."%' OR author LIKE '%".$word."%'
                                ORDER BY ".$parameter." ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><td>Numer teczki</td><td>Nazwa utworu</td><td>Ilość partytur</td><td>Autor</td><td>Nazwa teczki</td></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id_song"]."</td>
                  <td><a class = 'a' href='?action=song&id=".$row["id_song"]."'>".$row["name_song"]."</a></td>
                  <td>".$row["count"]."</td>
                  <td>".$row["author"]."</td>
                  <td>".$row["name_folder"]."</td>
             </tr>";
    }
    echo "</table>";
} else {
    echo "Nie ma danych";
}
?>