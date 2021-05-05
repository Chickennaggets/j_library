 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$login = $_GET["login"];
$stat = $_GET["status"];

$stat = !$stat;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "update accounts set activated = '$stat' where login = '$login'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    header('Location: users.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>