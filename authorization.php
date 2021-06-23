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
                    <h2 class="mb-5" style="text-align: center">Rejestracja</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Login <em style="font-size: 80%;">(*Min 5 znaków)</em></label>
                        <input type="text" class="form-control" name="log" onchange="checkform()" id="regLogin" required aria-describedby="loginHelp">
                        <span class="form-label" hidden></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Hasło <em style="font-size: 80%;">(*Min 6 znaków)</em></label>
                        <input type="text" class="form-control" id="has1" name="has1" onchange="checkform()" required aria-describedby="passHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail2" class="form-label"> Powtórz hasło</label>
                        <input type="text" class="form-control" id="has2" name="has2" onchange="checkform()" required aria-describedby="passHelp">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="checkRegulamin" onclick="checkform();">
                        <label class="form-check-label" for="#checkRegulamin">Akceptuję <a href="#">regulamin</a></label>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="button" class="btn btn-dark px-3" disabled onclick="reg();" value="Zarejestruj" id="btn_login">
                    </div>
                    <div class="text-center">
                        <a href="?section=authorization">Zaloguj</a>
                    </div>
                </form>
            </div>


    <?php
        break;
    case 'regist_query':
        $login = Get::post('log', '', GET::TYPE_STR);
        $pass = Get::post('has1', '', GET::TYPE_STR);

        $aUser = $oUser->newUser($login, $pass);

        if($aUser){
            echo '<div class="container-fluid w-100 pt-5" style="min-height: 100vh"><h4 class="text-center mt-5 mb-5">Konto zostało zarejestrowane. Żeby móc zalogować się potrzebujesz akceptacji administratora.</h4>
                      <div class="container text-center">
                         <a class="btn btn-dark mt-5" href="?section=authorization">Zaloguj</a>
                      </div>
                  </div>';
            ?>
            <?php
        }
        else
            echo 'Błąd, możliwe że taki login już zajęty';
        break;
    default: ?>

    <div class="container-fluid pt-5 w-25 needs-validation" novalidate style="margin: auto; height: 90vh;">
        <form method="post" action="?section=authorization&action=login" style="margin-top: 15vh">
            <h2 style="text-align: center">Zaloguj</h2>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Login</label>
                <input type="text" class="form-control" required name="log" aria-describedby="loginHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" required class="form-control" name="has">
            </div>
            <div class="container-fluid text-center" >
                <button type="submit" class="btn btn-dark px-3 mb-2" id="btn_login">Zaloguj</button>
            </div>
            <div class="mb-3 text-center">
                <a href="?section=authorization&action=registration">Rejestracja</a>
            </div>

        </form>
    </div>

    <?php
}





