<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

switch ($action){
    case 'show':
        $word = get::Get('word','',Get::TYPE_STR);
        $parameter = get::Get('parameter','',Get::TYPE_STR);
        $aUser = $oUser->getAll($word, $parameter);

        echo "<table class='table'>
                <tr>
                    <td>Login</td>
                    <td>Hasło</td>
                    <td>Aktywowano</td>
                    <td>Administrator</td>
                    <td>Data rejestracji</td>
                </tr>";

        while($row = $aUser->fetch_assoc()) {
            if ($_SESSION["online_login"] == $row["login"]) {
                $delete = "";
            } else {
                $delete = "<a class='c' href = '?section=users&action=delete&login=" . $row["login"] . "'>Usunąć</a>";
            }
            if ($row["activated"]) {
                $akt = "<td><a href='?section=users&action=changeStatus&login=" . $row["login"] . "&status=" . $row["activated"] . "' class='b'>Tak</a></td>";
            } else {
                $akt = "<td><a href='?section=users&action=changeStatus&login=" . $row["login"] . "&status=" . $row["activated"] . "' class='c'>Nie</a></td>";
            }
            if ($row["adminn"]) {
                $adm = "Tak";
            } else {
                $adm = "Nie";
            }
            echo "<tr><td>" . $row["login"] . "</td><td>" . $row["ac_password"] . "</td>" . $akt . "<td>" . $adm . "</td><td>" . $row["regist_date"] . "</td><td>$delete</tr>";
        }
        echo "</table>";

            break;
    case 'delete':
            $login = get::Get('login','',Get::TYPE_STR);
            $oUser->deleteUser($login);
        break;
    case 'changeStatus':
        $login = get::Get('login','',Get::TYPE_STR);
        $stat = get::Get('status','',Get::TYPE_STR);
        $oUser->changeStatus($login, $stat);
        break;
    default:
        ?>
            <select name="filters" class="edbx" id="filters" onclick="u_srch()" style="margin-right: 30px;" >
                <option hidden value="login">Filtruj wg</option>
                <option value="login">Loginu</option>
                <option value="regist_date">Daty rejestracji</option>
                <option value="activated">Aktywacji</option>
                <option value="adminn">Uprawnień</option>
            </select>
            <input type = "text" id="sz_text" class="edbx" placeholder="Szukaj*" onchange="u_srch()">
            <input type="button" value="Szukaj" class="btn" id="sz_btn" onclick="u_srch()" style="margin-left: 10px;"><br><br>
            <div id = "demo">
            </div>
        <script>
            u_srch();
        </script>
<?php

}