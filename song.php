<html>
<?php
    print_header();
?>
<body>
    <table>
        <tr>
            <td style="width: 180px;" valign="top">
                <?php
                print_nav_menu();
                ?>
            </td>
             <td valign="top" style="width: 80%;">
                 <div class="p_navigator" style="width: 100%;">
                    <?php
                    global $conn;

                    $id = getParameter($_GET["id"], 'Integer');

                    $sql = "SELECT id_song, name_song, count, author, folder.name_folder, song.note 
                            FROM song 
                            LEFT JOIN folder ON song.id_folder = folder.id_folder 
                            WHERE id_song = '$id';";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                      while($row = $result->fetch_assoc()) {
                      echo "<h1 align='center'>".$row["name_song"]."</h1><br><br><br><br>";
                      echo "<h2>Numer teczki: ".$row["id_song"]."<br><hr>Ilość partytur: ".$row["count"]."<br>
                            <hr>Autor: ".$row["author"]."<br>
                            <hr>Teczka: ".$row["name_folder"]."<br>
                            <hr>Notatki: ".$row["note"]."</h2>";
                          if($_SESSION["root"]){
                               echo "<br><br><br><a class = 'a' href=?action=edit_song&id=".$row["id_song"].">Edycja</a>";
                                echo "<br><br><a class = 'a' href=?action=delete_song_sql&id=".$row["id_song"].">Usunąć utwór</a>";
                          }

                      }
                    } else {
                        echo "Nie ma danych";
                    }
                    ?>
                 </div>
             </td>
        </tr>
    </table>
\</body>
</html>