<html>
<?php
    print_header();
?>
<body>
    <table>
        <tr><td style="width: 180px;" valign="top">
                <?php
                print_nav_menu();
                ?>
            </td>
             <td valign="top" style="width: 80%;">
                 <div class="p_navigator" style="width: 100%;">
<?php
$id = $_GET["id"];

$sql = "select id_song, name_song, count, author, folder.name_folder, song.note from song left join folder on song.id_folder = folder.id_folder where id_song = '$id';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
  while($row = $result->fetch_assoc()) {
    
      
  echo "<h1 align='center'>".$row["name_song"]."</h1><br><br><br><br>";
      
  echo "<h2>Numer teczki: ".$row["id_song"]."<br><hr>Ilość partytur: ".$row["count"]."<br><hr>Autor: ".$row["author"]."<br><hr>Teczka: ".$row["name_folder"]."<br><hr>Notatki: ".$row["note"]."</h2>";
      
      if($_SESSION["root"]){
           echo "<br><br><br><a class = 'a' href=edit_song.php?id=".$row["id_song"].">Edycja</a>";    
  echo "<br><br><a class = 'a' href=delete_song_sql.php?id=".$row["id_song"].">Usunąć utwór</a>"; 
      }

  }
} else {
  echo "Nie ma danych";
}
?>
                 </div>       </td>
        </tr>
    </table>
    </body>
</html>