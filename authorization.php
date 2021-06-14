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
            <div class="container-fluid pt-5 w-25" style="margin: auto; min-height: 100vh;">
                <form method="post" action="?section=authorization&action=regist_query" id="fform">
                    <h2 style="text-align: center">Rejestracja</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Login</label>
                        <input type="text" class="form-control" name="log" required aria-describedby="loginHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Hasło</label>
                        <input type="text" class="form-control" id="has1" name="has1" required aria-describedby="passHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> Powtóż hasło</label>
                        <input type="text" class="form-control" id="has2" name="has2" required aria-describedby="passHelp">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkRegulamin" onclick="checkreg();">
                        <label class="form-check-label" for="exampleCheck1">Akceptuję <a href="#">regulamin</label>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="button" class="btn btn-primary w-50" disabled onclick="reg();" value="Zarejestruj" id="btn_login">
                    </div>
                    <div class="text-center">
                        <a class = "a" href="?section=authorization">Zalogj</a>
                    </div>
                </form>
            </div>

        <!-- Modal window -->


    <?php
        break;
    case 'regist_query':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has1', '', GET::TYPE_STR);

        $aUser = $oUser->newUser($login, $pass);

        if($aUser){
            echo 'Konto zostało zarejestrowane. Żeby móc załogować się potrzebujesz akceptacji administratora.';
            ?>
            <?php
        }
        else
            echo 'Błąd, możliwe że taki login już zajęty';
        break;
    default: ?>

    <div class="container-fluid pt-5 w-25" style="margin: auto; height: 90vh;">
        <form method="post" action="?section=authorization&action=login" style="margin-top: 15vh">
            <h2 style="text-align: center">Zaloguj</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Login</label>
                <input type="text" class="form-control" name="log" aria-describedby="loginHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" class="form-control" name="has">
            </div>
            <div class="container-fluid text-center" >
                <button type="submit" class="btn btn-primary w-50 mb-2" id="btn_login">Zaloguj</button>
            </div>
            <div class="mb-3 text-center">
                <a href="?section=authorization&action=registration">Rejestracja</a>
            </div>

        </form>
    </div>
    <?php
}





