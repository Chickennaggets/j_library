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
                $delete = "<a class='c' href = '?action=del_user_sql&login=" . $row["login"] . "'>Usunąć</a>";
            }
            if ($row["activated"]) {
                $akt = "<td><a href='?action=activate&login=" . $row["login"] . "&status=" . $row["activated"] . "' class='b'>Tak</a></td>";
            } else {
                $akt = "<td><a href='?action=activate&login=" . $row["login"] . "&status=" . $row["activated"] . "' class='c'>Nie</a></td>";
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
    default:
        ?>
        <div class="p_navigator">
            <select name="filters" class="edbx" id="filters" onclick="f()" style="margin-right: 30px;" >
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
        </div>
        <script>
            u_srch();
            function u_srch(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("demo").innerHTML = this.responseText;
                    }
                };
                var word = document.getElementById("sz_text").value;
                var filt = document.getElementById("filters").value
                xhttp.open("GET", "?section=administrating&action=show&parameter="+filt+"&word="+word, true);
                xhttp.send();
            }
        </script>
<?php

}