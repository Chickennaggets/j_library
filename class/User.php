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
                        WHERE login = '$login' && ac_password = '$pass';";
        $result = $conn->query($sql);

        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $_SESSION["online_login"] = $login;
            $_SESSION["root"] = $row["adminn"];
            return $result;
        }
        else{
            return false;
        }
    }

    function Logout() {
        session_destroy();
        header('Location: ?section=authorization');
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
}