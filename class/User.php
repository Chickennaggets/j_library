<?php

const TABLE = 'accounts';

class User
{
    function isLogin() {
        if(isset($_SESSION["online_login"])){
            return true;
        }
        else{
            return false;
        }
    }

    function isAdmin() {
        if($_SESSION["root"]){
            return true;
        }
        else{
            return false;
        }
    }

    function Login($login, $pass) {
        global $conn;

        $sql = "SELECT login, activated, adminn 
                    FROM accounts 
                        WHERE login = '$login' && ac_password = PASSWORD('$pass') && activated = true;";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $_SESSION["online_login"] = $login;
            $_SESSION["root"] = $row["adminn"];
            return true;
        }
        else{
            return false;
        }
    }

    function Logout() {
        session_destroy();
        header('Location: ?section=info_main&ajax');
    }

    function getAll($word, $parameter){
        global $conn;

        $sql = "SELECT login, ac_password, activated, adminn, regist_date 
        FROM accounts
        WHERE login LIKE '%".$word."%'
        ORDER BY ".$parameter.";";

        $result = $conn->query($sql);

        if (!$result->num_rows) {
            return false;
        }
        return $result;
    }

    function deleteUser($login){
        global $conn;

        $sql = "DELETE FROM accounts 
                    WHERE login='$login';";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=users');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    function changeStatus($login, $stat){
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
    function newUser($login, $pass){
        global $conn;

        $sql = "SELECT login 
                FROM accounts 
                WHERE login = '$login';";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return false;
        }
        else {
            $sql1 = "INSERT INTO accounts(login, ac_password, activated, adminn)
            values('$login', PASSWORD('$pass'), false, false);";

            $result1 = $conn->query($sql1);

            if ($result1 == TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }
}