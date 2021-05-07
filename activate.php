 <?php
 global $conn;

$login = getParameter($_GET["login"], 'String');
$stat = getParameter($_GET["status"], 'String');

$stat = !$stat;

$sql = "UPDATE accounts SET activated = '$stat' 
            WHERE login = '$login'";

$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    header('Location: ?action=users');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>