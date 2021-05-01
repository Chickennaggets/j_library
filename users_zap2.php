 <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "select login, ac_password, activated, adminn, regist_date from accounts order by regist_date;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table class='table'>";
  echo "<tr><td>Login</td><td>Hasło</td><td>Aktywowano</td><td>Administrator</td><td>Data rejestracji</td><td></td></tr>";  
  while($row = $result->fetch_assoc()) {
      if($_SESSION["online_login"]==$row["login"]){
          $delete = "";
      }
      else{
          $delete = "<a class='c' href = 'del_user_sql.php?login=".$row["login"]."'>Usunąć</a>";
      }
      if($row["activated"]){
          $akt = "<td><a href='activate.php?login=".$row["login"]."&status=".$row["activated"]."' class='b'>Tak</a></td>";
      }
      else{
          $akt = "<td><a href='activate.php?login=".$row["login"]."&status=".$row["activated"]."' class='c'>Nie</a></td>";
      }
      if($row["adminn"]){
          $adm = "Tak";
      }
      else{
          $adm = "Nie";
      }
  echo "<tr><td>".$row["login"]."</td><td>".$row["ac_password"]."</td>".$akt."<td>".$adm."</td><td>".$row["regist_date"]."</td><td>$delete</tr>";
  }
    echo "</table>"; 
    
} else {
  echo "Nie ma danych";
}
$conn->close();
?>