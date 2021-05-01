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
           <a class = "a" href="add_fold.php">Nowa teczka</a><br><br>    
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
$conn->close();
?>
                 </div>
       </td>
    </table>
    </body>
</html>