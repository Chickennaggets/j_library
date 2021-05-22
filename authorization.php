<?php
global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

switch ($action) {
    case 'login':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has', '', GET::TYPE_STR);
        $aUser = $oUser->Login($login, $pass);

        if ($aUser) {
            header('Location:  index.php');
        }
        else {
            header("Location:  ?section=error&texterror=Incorrect_login_or_password");
        }
        break;
    default: ?>
        <div class="reg_form">
            <form method="post" action="?section=authorization&action=login" class = "form" id="fform">
                <h1 style="text-align: center; margin: 30px; background-color: transparent;">Zaloguj się</h1>
                <input type="text" class="edbx" name="log" id="log" required placeholder="Login*" data-validate><br><br>
                <span class="help-text"></span>
                <input type="password" class="edbx" name="has" id="has" required placeholder="Hasło*" data-validate><br><br>
                <input type="submit" class="btn" value="Zaloguj"><br><br>
                <a class = "a" href="?section=users&action=registration">Zarejestruj</a>
            </form>
        </div>
    <?php
}





