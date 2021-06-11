<?php
global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

switch ($action) {
    case 'login':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has', '', GET::TYPE_STR);
        $oUser->Login($login, $pass);

        if ($oUser->Login($login, $pass)) {
            header('Location:  index.php');
        }
        else {
            header("Location:  ?section=error&text=Incorrect_login_or_password");
        }
        break;
    case 'registration':
        ?>

            <form method="post" action="?section=authorization&action=regist_query" class = "form" id="fform" style="text-align: center;padding-top: 5%;">
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

    <div class="container-fluid pt-5 w-25" style="margin: auto;">
        <form method="post" action="?section=authorization&action=login">
            <h2 style="text-align: center">Zaloguj</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Login</label>
                <input type="text" class="form-control" name="log" aria-describedby="loginHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" class="form-control" name="has">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Akceptuję regulamin</label>
            </div>
            <div class="container-fluid" style="text-align: center">
                <button type="submit" class="btn btn-primary">Zaloguj</button>
                <br><a href="?section=authorization&action=registration">Rejestracja</a>
            </div>

        </form>
    </div>
    <?php
}





