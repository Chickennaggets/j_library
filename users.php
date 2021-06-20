<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

switch ($action){
    case 'show':
        $word = get::Get('word','',Get::TYPE_STR);
        $parameter = get::Get('parameter','',Get::TYPE_STR);
        $aUser = $oUser->getAll($word, $parameter);

        echo "<div class='container gx-5 mt-3' style='min-height: 100vh'><table class='table table-hover'>
                <tr>
                    <td>Login</td>
                    <td class='text-center'>Typ konta</td>
                    <td class='text-center'>Data rejestracji</td>
                </tr>";

        while($row = $aUser->fetch_assoc()) {
        $ac_type = translate($row["ac_type"]);
                echo '<tr><td><a href="?section=users&action=user&id='.$row["id_account"].'">'.$row["login"].'</a></td>
                          <td class="text-center">'.$ac_type.'</td>
                          <td class="text-center">'.$row["regist_date"].'</td>
                      </tr>';
        }
        echo "</table></div>";

            break;
    case 'logout':
        $oUser ->Logout();
        break;
    case 'delete':
            $login = get::Get('login','',Get::TYPE_STR);
            $oUser->deleteUser($login);
        break;

    case 'user':
        $id = get::Get('id',0,Get::TYPE_INT);

        $aUser = $oUser->getById($id);

        if (!$aUser) {
            echo "Nie ma danych";
        }
        else{
            $ac_type = translate($aUser["ac_type"]);
        echo '

            <div class="container-fluid gx-5 w-50" style="min-height: 100vh;">
                <form method="post" action="?section=users&action=updater">
                    <div class="mb-3">
                        <h3 class="text-center">Ustawienia - '.$aUser["login"].'</h3>
 
            <button type="button" class="btn float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="black" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Napewno chcesz usunąć to konto ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary w-25" onclick=document.location="?section=users&action=delete&login='.$aUser["login"].'">Tak</button>
                            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Nie</button>
                        </div>
                    </div>
                </div>
            </div>
                        
                        
                        
                    </div>
                    <div class="mb-3">
                        <input type="number" name="id" hidden value="'.$aUser["id_account"].'">
                        <label class="form-label">Rodzaje kont:</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Chórzysta</b> - Ma nieograniczony dostęp bo całej biblioteki, jej midów i PDF-ów.</label>
                        <label class="form-label"><b>Gość</b> - Ma dostęp tylko do listy utworów. Może pobierać midy i PDF-y ograniczoną przez moderatora/administratora ilość razy.</label>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Rodzaj konta</label>
                        <select class="form-select" id="selactype" name="ac_type" onchange="changesel()" aria-label="Default select example">
                            <option selected hidden value="'.$aUser["ac_type"].'">'.$ac_type.'</option>
                            <option value="guest">Gość</a></option>
                            <option value="user">Chórzysta</a></option>
                            <option value="moderator">Moderator</a></option>
                        </select>
                    </div>

                    <div id="count_downloads" '; if($aUser["ac_type"]!="guest"){echo "hidden";} echo '>
                    <div class="mb-2">
                        <label class="form-label"><b>Ilość pobrań</b> - Tyle razy Gość ma możliwość pobierać jakieś utwory.</label>
                    </div>
                    <div class="mb-5">
                        <label class="form-label" for="count_download">Ilość pobrań</label>
                        <input type="number" class="form-control" name="count_download" value="'.$aUser["count_downloads"].'">
                    </div>
                    <div class="mb-2">
                    <label class="form-label">Jeśli konto będzie wyłączone - osoba nie będzie mogła zalogować się.</label>
                    </div>
                    </div>
                    <div class="mb-5">
                        <div class="form-check form-switch">
                          <input class="form-check-input" name="status" '; if($aUser["activated"]){ echo 'checked';} echo ' type="checkbox" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Wyłączone / Włączone konto</label>
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" class="btn btn-dark w-25" value="Zapisz">
                    </div>
                </form>
            </div>';

        }

        break;

    case 'updater':
        $id = get::post('id',0,Get::TYPE_INT);
        $ac_type = get::post('ac_type', '', Get::TYPE_STR);
        $count_downloads = get::post('count_download', 0, Get::TYPE_INT);
        $stan = get::post('status', '', Get::TYPE_STR);

        if($stan=='on'){
            $stan = 1;
        }
        else{
            $stan = 0;
        }

        $oUser->updateUser($id, $ac_type, $count_downloads, $stan);

        break;
    case 'changeStatus':
        $login = get::Get('login','',Get::TYPE_STR);
        $stat = get::Get('status','',Get::TYPE_STR);

        $oUser->changeStatus($login, $stat);
        break;

    case 'transfer':
        $id = get::get('id', 0, Get::TYPE_INT);
        $ac_type = get::post('ac_type', '', Get::TYPE_STR);

        $oUser->transfer($id, $ac_type);

        break;
    default:
        ?>
    <div class="container gx-5">
        <div class="row">
            <div class="col">
                <select name="filters" class="form-select" id="filters" onclick="u_srch()" >
                    <option hidden value="login">Filtruj wg</option>
                    <option value="login">Loginu</option>
                    <option value="regist_date">Daty rejestracji</option>
                    <option value="activated">Aktywacji</option>
                    <option value="adminn">Uprawnień</option>
                </select>
            </div>
            <div class="col">
                <input type = "text" id="sz_text" class="form-control" placeholder="Szukaj*" onchange="u_srch()">
            </div>
            <div class="col">
                <button value="Szukaj" class="btn btn-dark" id="sz_btn" onclick="u_srch()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    Szukaj
                </button>
            </div>
        </div>
    </div>
            <div id = "demo">
            </div>
        <script>
            u_srch();
        </script>
<?php
        break;

}