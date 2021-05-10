<?php
global $conn;
global $action;
global $oUser;

switch ($action){
    case "activate":
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
        break;

    case "add_fold_sql":

        $name_fold = getParameter($_POST['name_fold'], 'String');
        $notes = getParameter($_POST['note'], 'String');

        $sql = "INSERT INTO folder(name_folder, note) 
            VALUES ('$name_fold', '$notes');";


        if ($conn->query($sql) === TRUE) {
            echo "Teczka dodana<br>";
            header('Location: ?action=folders');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<br><br>Możliwe że taka teczka już istnieje.";
            echo "<br><a href='?action=add_fold'>Cofnij</a>";
        }
        break;

    case "add_song_sql":
        $song_name = getParameter($_POST['song_name'], 'String');
        $count_p = getParameter($_POST['count_p'], 'Integer');
        $autor = getParameter($_POST['autor'], 'String');
        $folders = getParameter($_POST['folders'],'String');
        $notatki = getParameter($_POST['notatki'], 'String');

        $sql = "INSERT INTO song(name_song, count, author, id_folder, note)
            values ('$song_name', $count_p, '$autor', $folders, '$notatki');";

        if ($conn->query($sql) === TRUE) {
            echo "Nowy utwór został dodany<br>";
            echo "<meta http-equiv='refresh' content='1; url=?action=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        break;

    case "authorization":
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
        break;

    case "del_folder_sql":
        $name_folder = getParameter($_GET["name_folder"], 'String');

        $sql = "DELETE FROM folder 
        WHERE name_folder='$name_folder';";

        if ($conn->query($sql) === TRUE) {
            header('Location: folders.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<br><br><br>Nie da się usunąć teczki w której są utwory ! Najperw trzeba pousuwać utwory znajdujące się w tej teczce, albo przenieść utwory w inne teczki.<br><br>";
            echo "<a href='folders.php'>Cofnij</a>";
        }
        break;

    case "del_user_sql":
        $login = getParameter($_GET["login"], 'String');

        $sql = "DELETE FROM accounts 
        WHERE login='$login';";


        if ($conn->query($sql) === TRUE) {
            header('Location: users.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        break;

    case "delete_song_sql":
        $id = getParameter($_GET["id"], 'String');

        $sql = "DELETE FROM song 
        WHERE id_song=$id";


        if ($conn->query($sql) === TRUE) {
            echo "Utwór został usunięty<br>";
            echo "<meta http-equiv='refresh' content='1; url=?action=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        break;

    case "edit_song_sql":
        $song_name = getParameter($_POST['song_name'], 'String');
        $count_p = getParameter($_POST['count_p'], 'Integer');
        $autor = getParameter($_POST['autor'], 'String');
        $folders = getParameter($_POST['folders'], 'String');
        $notatki = getParameter($_POST['notatki'],'String');
        $id = getParameter($_GET['id_s'],'Integer');


        $sql = "UPDATE song 
            SET 
                name_song = '$song_name', 
                count = '$count_p', 
                author = '$autor', 
                id_folder = '$folders', 
                note = '$notatki' 
            WHERE id_song = $id;";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            echo "<meta http-equiv='refresh' content='1; url=?action=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        break;

    case "regist_zap":
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
        break;
    default:
        echo "Error";
        break;
}
?>
