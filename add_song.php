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
             <td valign="top" style="width: 80%">
                 <div class="p_navigator" style="width: 100%;">
                 
         <div class="regform_d"><form method="post" action="add_song_sql.php" class = "form">
          <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowy utwór</h1>
	
	<input type="text" class="edbx" name="song_name" id="song_name" required placeholder="Nazwa utworu*" data-validate><br><br>
   
	<input type="number" class="edbx" name="count_p" id="count_p" required placeholder="Ilość partytur*" data-validate><br><br>
  
	<input type="text" class="edbx" name="autor" id="autor" required placeholder="Autor" data-validate><br><br>
       
        <?php

$sql = "select * from folder order by name_folder";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<select name='folders' id='folders' class='edbx'>";
    echo "<option hidden value='8'>Teczka</option>";
  while($row = $result->fetch_assoc()) {
    echo "<option value='".$row["id_folder"]."'>".$row["name_folder"]."</option>";
  }
    echo "</select><br><br>";
} else {
  echo "Nie ma danych";
}
?>
       
             <textarea name="notatki" id="notatki" placeholder="Notatki"></textarea><br><br>
	<input type="submit" name="submit" class="btn" value="Dodaj">
</form>
</div>
</div>        
</td>
</table>
</body>
</html>