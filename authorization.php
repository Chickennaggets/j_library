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
    case 'registration':
        ?>
        <div class="reg_form">
            <form method="post" action="?section=authorization&action=regist_query" class = "form" id="fform">
                <h1 style="text-align: center; margin: 30px; background-color: transparent;">Rejestracja</h1>

	            <input type="text" class="edbx" name="log" id="log" required placeholder="Login*" data-validate><br><br>
                <span class="help-text"></span>

	            <input type="text" class="edbx" name="has1" id="has1" required placeholder="Hasło*" onchange="checkpasswords()" data-validate><br>
                <span class="log-text"></span><br>

                <input type="text" class="edbx" name="has2" id="has2" required placeholder="Powtóż hasło*" onchange="checkpasswords()" data-validate><br>
                <span class="help-text"></span><br>

                <input type="button" onclick="reg()" class="btn" value="Zarejestruj"><br><br>
                <a class = "a" href="?section=authorization">Zalogj</a>
            </form>
        </div>
    <?php
        break;
    case 'regist_query':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has1', '', GET::TYPE_STR);

        $aUser = $oUser->newUser($login, $pass);

        if($aUser)
            echo 'Konto zostało zarejestrowane. Żeby móc załogować się potrzebujesz akceptacji administratora.';
        else
            echo 'Błąd, możliwe że taki login już zajęty';
        break;
    default: ?>
        <div class="reg_form">
            <form method="post" action="?section=authorization&action=login" class = "form" id="fform">
                <h1 style="text-align: center; margin: 30px; background-color: transparent;">Zaloguj się</h1>
                <input type="text" class="edbx" name="log" id="log" required placeholder="Login*" data-validate><br><br>
                <span class="help-text"></span>
                <input type="password" class="edbx" name="has" id="has" required placeholder="Hasło*" data-validate><br><br>
                <input type="submit" class="btn" value="Zaloguj"><br><br>
                <a class = "a" href="?section=authorization&action=registration">Zarejestruj</a>
            </form>
        </div>
    <?php
}





