 <?php
$login = mysqli_real_escape_string($conn, $_GET["login"]);
$stat = mysqli_real_escape_string($conn, $_GET["status"]);

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