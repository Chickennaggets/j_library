 <?php

global $conn;

 $parameter = getParameter($_GET['parameter'], 'String');
 $word = getParameter($_GET['word'], 'String');

$sql = "SELECT login, ac_password, activated, adminn, regist_date 
        FROM accounts
        WHERE login LIKE '%".$word."%'
        ORDER BY ".$parameter.";";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><td>Login</td><td>Hasło</td><td>Aktywowano</td><td>Administrator</td><td>Data rejestracji</td><td></td></tr>";
    while($row = $result->fetch_assoc()) {
        if($_SESSION["online_login"]==$row["login"]){
                $delete = "";
            }
            else{
                $delete = "<a class='c' href = '?action=del_user_sql&login=".$row["login"]."'>Usunąć</a>";
            }
            if($row["activated"]){
                $akt = "<td><a href='?action=activate&login=".$row["login"]."&status=".$row["activated"]."' class='b'>Tak</a></td>";
            }
            else{
                $akt = "<td><a href='?action=activate&login=".$row["login"]."&status=".$row["activated"]."' class='c'>Nie</a></td>";
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
?>