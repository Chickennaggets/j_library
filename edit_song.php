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
                    <div class="regform_d">
                    <?php
                    global $conn;

                    $id = getParameter($_GET["id"], 'Integer');

                    $sql = "SELECT id_song, name_song, count, author, folder.name_folder, song.note 
                            FROM song 
                            LEFT JOIN folder ON song.id_folder = folder.id_folder 
                            WHERE id_song = ".$id.";";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                      while($row = $result->fetch_assoc()) {
                      echo "<form method='post' action='?action=edit_song_sql&id_s=".$id."' class = 'form'>
                      <h1 style='text-align: center; margin: 30px; background-color: transparent;'>Edycja utworu - ".$row["name_song"]."</h1>
                      <input type='text' class='edbx' name='song_name' id='song_name' required placeholder='Nazwa utworu' value='".$row["name_song"]."' data-validate><br><br>
                      <input type='number' class='edbx' name='count_p' id='count_p' required placeholder='Ilość partytur' value='".$row["count"]."' data-validate><br><br>
                      <input type='text' class='edbx' name='autor' id='autor' required placeholder='Autor*' value='".$row["author"]."' data-validate><br><br>
                      <textarea class='edbx' name='notatki' id='notatki' placeholder='Notatki*' data-validate>".$row["note"]."</textarea><br><br>
                      Numer teczki: <label>".$row["id_song"]."</label><br><br>";
                      }
                    } else {
                      echo "Nie ma danych";
                    }
                    ?>
       
                    <?php

                        $sql = "SELECT id_folder, name_folder 
                                FROM folder 
                                ORDER BY name_folder";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                          echo "Teczka <select class = 'edbx' name='folders' id='folders'>";
                          while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row["id_folder"]."'>".$row["name_folder"]."</option>";
                          }
                            echo "</select><br><br>";
                        } else {
                          echo "Nie ma danych";
                        } ?>
	            <input type="submit" name="submit"  class="btn" value="Zachowaj">
                        </form>
                    </div>
                </div>
             </td>
    </table>
</body>
</html>