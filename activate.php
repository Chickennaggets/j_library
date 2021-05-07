 <?php
$login = $_GET["login"];
$stat = $_GET["status"];

$stat = !$stat;

$sql = "update accounts set activated = '$stat' where login = '$login'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    header('Location: users.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>