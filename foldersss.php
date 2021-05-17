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
             <a class = "a" href="?action=add_fold">Nowa teczka</a><br><br>
             <?php
        global $conn;

        $sql = "SELECT name_folder, note 
                FROM folder 
                ORDER BY name_folder;";

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