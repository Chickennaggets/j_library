<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <div class="header">
        <h1 class="zagl">Biblioteka Chóru Katedralnego</h1>
    </div>
    
</head>
<body>
    <table>
         <tr><td style="width: 180px;" valign="top">
             <div class="navigator">
                    <?php
                 session_start();
                 echo $_SESSION["online_login"]."<br>";
                 if($_SESSION["root"]){
                     echo "(Administrator)<br><br>";
                 }else{
                     echo "(Użytkownik)<br><br>";
                 }?>
             <a href="main.php" class = "a">Główna</a><br>
                 <?php
                 if($_SESSION["root"]){
                     echo "<a href='add_song.php' class = 'a'>Nowy utwór</a><br>";
                     echo "<a href='folders.php' class = 'a'>Teczki</a><br>";
                     echo "<a href='users.php' class = 'a'>Użytkowniki</a><br>";
                 }                
                 ?>
              <a href="authorization.html" class = "a">Wyloguj</a><br>
             </div>
             </td>
             <td valign="top" style="width: 80%;">
              <div class="p_navigator" style="width: 100%;">   
         <div class="regform_d">
<?php
$id = $_GET["id"];

$sql = "select id_song, name_song, count, author, folder.name_folder, song.note from song left join folder on song.id_folder = folder.id_folder where id_song = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
  while($row = $result->fetch_assoc()) {
  echo "<form method='post' action='edit_song_sql.php?id_s=$id' class = 'form'>";
  echo "<h1 style='text-align: center; margin: 30px; background-color: transparent;'>Edycja utworu - ".$row["name_song"]."</h1>";
  echo "<input type='text' class='edbx' name='song_name' id='song_name' required placeholder='Nazwa utworu' value='".$row["name_song"]."' data-validate><br><br>";
  echo "<input type='number' class='edbx' name='count_p' id='count_p' required placeholder='Ilość partytur' value='".$row["count"]."' data-validate><br><br>";
  echo "<input type='text' class='edbx' name='autor' id='autor' required placeholder='Autor*' value='".$row["author"]."' data-validate><br><br>";
  echo "<textarea class='edbx' name='notatki' id='notatki' placeholder='Notatki*' data-validate>".$row["note"]."</textarea><br><br>";
  echo "Numer teczki: <label>".$row["id_song"]."</label><br><br>";
  
  }
} else {
  echo "Nie ma danych";
}
?>
       
        <?php

$sql = "select * from folder order by name_folder";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "Teczka <select class = 'edbx' name='folders' id='folders'>";
  while($row = $result->fetch_assoc()) {
    echo "<option value='".$row["id_folder"]."'>".$row["name_folder"]."</option>";
  }
    echo "</select><br><br>";
} else {
  echo "Nie ma danych";
}
?>
        
	<input type="submit" name="submit"  class="btn" value="Zachowaj">
                  </div>
                 </div>
             
</form>     
</div>        
             </td>
    </table>
    </body>
</html>