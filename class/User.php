<?php

const TABLE = 'accounts';

class User
{
    function isLogin()
    {
        if (isset($_SESSION["online_login"])) {
            return true;
        } else {
            return false;
        }
    }

    function isAdmin() // Модератор
    {
        if ($_SESSION["root"]=='admin' || $_SESSION["root"]=='moderator') {
            return true;
        } else {
            return false;
        }
    }

    function isSuperAdmin(){
        if ($_SESSION["root"]=='admin') {
            return true;
        } else {
            return false;
        }
    }

    function isGuest(){
        if ($_SESSION["root"]=='guest') {
            return true;
        } else {
            return false;
        }
    }

    function Login($login, $pass)
    {
        global $conn;

        $sql = "SELECT login, activated, ac_type 
                    FROM accounts 
                        WHERE login = '$login' && ac_password = PASSWORD('$pass') && activated = true;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["online_login"] = $login;
            $_SESSION["root"] = $row["ac_type"];
            return true;
        } else {
            return false;
        }
    }

    function Logout()
    {
        session_destroy();
        header('Location: ?section=authorization');
    }

    function getAll($word, $parameter)
    {
        global $conn;

        $sql = "SELECT id_account, login, ac_type, regist_date 
        FROM accounts
        WHERE login LIKE '%" . $word . "%'
        ORDER BY " . $parameter . ";";

        $result = $conn->query($sql);

        if (!$result->num_rows) {
            return false;
        }
        return $result;
    }

    function deleteUser($login)
    {
        global $conn;

        $sql = "DELETE FROM accounts 
                    WHERE login='$login';";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=users');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function changeStatus($login, $stat)
    {
        global $conn;

        $stat = !$stat;

        $sql = "UPDATE accounts SET activated = '$stat' 
            WHERE login = '$login'";

        $result = $conn->query($sql);

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=users');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function newUser($login, $pass)
    {
        global $conn;

        $sql = "SELECT login 
                FROM accounts 
                WHERE login = '$login';";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return false;
        } else {
            $sql1 = "INSERT INTO queries(login, ac_password)
            values('$login', PASSWORD('$pass'));";

            $result1 = $conn->query($sql1);

            if ($result1 == TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }

    function countQueries(){
        global $conn;

        $sql = "SELECT COUNT(*) as cnt
                FROM queries;";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        return $row["cnt"];

    }

    function getAllQueries(){
        global $conn;

        $sql = "SELECT id_query, login, regist_date FROM queries";

        $result = $conn->query($sql);

        if ($result) {
            return $result;
        }
        return false;
    }
    function deleteQuery($id){
        global $conn;

        $sql = "DELETE FROM queries 
                    WHERE id_query='$id';";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=queries');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function transfer($id, $ac_type){
        global $conn;

        $sql = "SELECT login, ac_password FROM queries WHERE id_query = '$id';";

        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc() ;
                $login = $row["login"];
                $pass = $row["ac_password"];
        }

        $sql = "INSERT INTO accounts(login, ac_password, activated, ac_type, count_downloads)
                values('$login', '$pass', false,'$ac_type',0);";

        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $sql = "DELETE FROM queries WHERE id_query = '$id'";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=users');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    function getCountDownloads($login){
        global $conn;

        $sql = "SELECT count_downloads
                FROM accounts
                WHERE login = '$login';";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        return $row["count_downloads"];
    }

    function getById($id){
        global $conn;

        $sql = "SELECT id_account, login, activated, ac_type, count_downloads, regist_date 
        FROM accounts
        WHERE id_account = '$id';";

        $result = $conn->query($sql);
        if (!$result->num_rows) {
            return false;
        }

        return $result->fetch_assoc();
    }

    function updateUser($id, $ac_type, $count_downloads, $stan){
        global $conn;

        $sql = "UPDATE accounts 
            SET 
                ac_type = '$ac_type', 
                count_downloads = '$count_downloads', 
                activated = '$stan' 
            WHERE id_account = '$id';";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            header('Location: ?section=users');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

