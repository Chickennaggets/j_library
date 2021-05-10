 <?php
 global $conn;

$login = getParameter($_POST['log'], 'String');
$pass = getParameter($_POST['has1'], 'String');

$sql = "SELECT login 
        FROM accounts 
        WHERE login = '$login';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "Ten login już jest zajęty";
}
else {
    $sql1 = "INSERT INTO accounts(login, ac_password, activated, adminn)
            values('$login', '$pass', false, false);";

    $result1 = $conn->query($sql1);

    if ($result1 == TRUE) {
    echo "Konto zostało zarejestrowane. Żeby móc załogować się i korzystać z biblioteki potrzebna jest aktywacja administratora. ";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
echo "<br><a href='?action=authorization'>Zaloguj</a>";
?>