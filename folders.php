<html>
<?php
    print_header();
?>
<body>
    <table>
        <tr><?php
                print_nav_menu();
            ?>
             <td valign="top" style="width: 80%;">
                 <div class="p_navigator" style="width: 100%;">
           <a class = "a" href="add_fold.php">Nowa teczka</a><br><br>    
        <?php

$sql = "select name_folder, note from folder order by name_folder;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
  
  echo "<table class='table'>";
  echo "<tr><td>Nazwa teczki</td><td>Notatki</td><td></td></tr>";  
  while($row = $result->fetch_assoc()) {
   $delete = "<a class='c' href = 'del_folder_sql.php?name_folder=".$row["name_folder"]."'>Usunąć</a>";   
  echo "<tr><td>".$row["name_folder"]."</td><td>".$row["note"]."</td><td>".$delete."</td></tr>";
  }
    echo "</table>"; 
    
} else {
  echo "Nie ma danych";
}
?>
                 </div>
       </td>
    </table>
    </body>
</html>