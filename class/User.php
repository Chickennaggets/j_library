<?php

const TABLE = 'table_name';

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

    function Login($login, $root) {
        $_SESSION["online_login"] = $login;
        $_SESSION["root"] = $root;
        header('Location: ?action=main');
    }

    function Logout() {
        session_destroy();
        header('Location: ?action=authorization');
    }
}