 <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$login = $_POST['log'];
$pass = $_POST['has1'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "select login from accounts where login = '$login';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  echo "Ten login już jest zajęty";

}
else {
  $sql1 = "insert into accounts(login, ac_password, activated, adminn) values('$login', '$pass', false, false);";
  $result = $conn->query($sql1);
  if ($conn->query($sql1) === TRUE) {  
  echo "Konto zostało zarejestrowane. Żeby móc załogować się i korzystać z biblioteki potrzebna jest aktywacja administratora. ";
      } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
echo "<br><a href='authorization.html'>Zaloguj</a>";
$conn->close();
?>