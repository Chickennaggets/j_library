 <?php

global $conn;
global $oUser;

$login = getParameter($_POST['log'],'String');
$pass = getParameter($_POST['has'], 'String');

$sql = "SELECT login, activated, adminn 
        FROM accounts 
        WHERE login = '$login' && ac_password = '$pass';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if(!$row["activated"]){
            echo "Konto nie jest aktywne. Skontaktuj się z administratorem, aby aktywować swoje konto.";
        }
        else if($row["activated"]){
            $oUser->Login($row["login"],$row["adminn"]);
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