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
        if(isset($_SESSION["root"])){
            return true;
        }
        else{
            return false;
        }
    }

    function Login($login, $root) {
        $_SESSION["online_login"] = $login;
        $_SESSION["root"] = $root;
        header('Location: ?section=main');
    }

    function Logout() {
        session_destroy();
        header('Location: ?action=authorization');
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