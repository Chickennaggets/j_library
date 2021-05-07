 <?php
session_destroy();
global $conn;
$login = getParameter($_POST['log'],'String');
$pass = getParameter($_POST['has'], 'String');



$sql = "SELECT activated, adminn 
        FROM accounts 
        WHERE login = '$login' && ac_password = '$pass';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    if($row["activated"]==false){
        echo "Konto nie jest aktywne. Skontaktuj się z administratorem, aby aktywować swoje konto.";
    }
    else if($row["activated"]==true){
     $_SESSION["online_login"] = $row["login"];
     $_SESSION["root"] = $row["adminn"];
     header('Location: main.php');   
    }
    else{
        echo "ERROR";
    }
}
}
else {
  echo "Nieprawidłowy login albo hasło";
}
echo "<br><a href='?action=authorization'>Zaloguj</a>";
?>