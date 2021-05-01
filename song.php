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
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";
                 
$id = $_GET["id"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
$conn->close();
?>
                 </div>       </td>
        </tr>
    </table>
    </body>
</html>