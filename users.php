<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

switch ($action){
    case 'show':
        $word = get::Get('word','',Get::TYPE_STR);
        $parameter = get::Get('parameter','',Get::TYPE_STR);
        $aUser = $oUser->getAll($word, $parameter);

        echo "<div class='container gx-3 mt-3' style='min-height: 90vh'><table class='table table-hover'>
                <tr>
                    <td>Login</td>
                    <td>Aktywowano</td>
                    <td>Typ konta</td>
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

            $ac_type = $row["ac_type"];

            echo "<tr><td>" . $row["login"] . "</td>" . $akt . "<td>" . $ac_type . "</td><td>" . $row["regist_date"] . "</td><td>$delete</tr>";
        }
        echo "</table></div>";

            break;
    case 'logout':
        $oUser ->Logout();
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

    case 'transfer':
        $id = get::get('id', 0, Get::TYPE_INT);
        $ac_type = get::post('ac_type', '', Get::TYPE_STR);

        $oUser->transfer($id, $ac_type);

        break;
    default:
        ?>
    <div class="container gx-5">
        <div class="row">
            <div class="col">
                <select name="filters" class="form-select" id="filters" onclick="u_srch()" >
                    <option hidden value="login">Filtruj wg</option>
                    <option value="login">Loginu</option>
                    <option value="regist_date">Daty rejestracji</option>
                    <option value="activated">Aktywacji</option>
                    <option value="adminn">Uprawnień</option>
                </select>
            </div>
            <div class="col">
                <input type = "text" id="sz_text" class="form-control" placeholder="Szukaj*" onchange="u_srch()">
            </div>
            <div class="col">
                <input type="button" value="Szukaj" class="btn btn-primary" id="sz_btn" onclick="u_srch()" >
            </div>
        </div>
    </div>
            <div id = "demo">
            </div>
        <script>
            u_srch();
        </script>
<?php
        break;

}