<?php

global $conn, $oUser, $section;

$action = Get::get('action', '', GET::TYPE_STR);
$error = Get::get('error', '', GET::TYPE_STR);

switch ($action) {
    case 'login':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has', '', GET::TYPE_STR);
        $oUser->Login($login, $pass);

        if ($oUser->Login($login, $pass)) {
            header('Location:  index.php');
        }
        else {
            header("Location:  ?section=authorization&err");
        }
        break;

    case 'regist_query':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has1', '', GET::TYPE_STR);

        if ($aUser = $oUser->newUser($login, $pass)) {
            echo 'Konto zostało zarejestrowane. Żeby móc załogować się potrzebujesz akceptacji administratora.';
        } else {
            echo 'Błąd, możliwe że taki login już zajęty';
        }
        break;

    default:
        if ($oUser->isLogin()) {
            header('Location: ?section=main');
        }

        $data = [];
        if ($error == 'incorrect_login_or_password') {
            $data['error'] = '<div class="error">Incorrect login or password!</div>';
        }

        echo Tmpl::getTmpl('login', $data, $section);
}