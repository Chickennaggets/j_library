 <?php
 global $conn;

$login = getParameter($_GET["login"], 'String');

$sql = "DELETE FROM accounts 
        WHERE login='$login';";


if ($conn->query($sql) === TRUE) {
  header('Location: users.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>