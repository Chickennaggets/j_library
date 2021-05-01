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
             <td valign="top" style="width: 80%">
                 <div class="p_navigator" style="width: 100%;">
                 
         <div class="regform_d"><form method="post" action="add_song_sql.php" class = "form">
          <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowy utwór</h1>
	
	<input type="text" class="edbx" name="song_name" id="song_name" required placeholder="Nazwa utworu*" data-validate><br><br>
   
	<input type="number" class="edbx" name="count_p" id="count_p" required placeholder="Ilość partytur*" data-validate><br><br>
  
	<input type="text" class="edbx" name="autor" id="autor" required placeholder="Autor" data-validate><br><br>
       
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
$conn->close();
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