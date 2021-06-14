<?php


global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);


switch ($action) {
    case 'we':
        echo '';
        break;
    default:
        $aUser = $oUser->getAllQueries();

        if($aUser){
            echo '
                <div class="container-fluid w-50" style="min-height: 100vh;">
                

                    <h2 class="text-center mb-3">Wnioski o rejestrację</h2>
            ';
                while ($row = $aUser->fetch_assoc()) {
                    echo'<div class="container-fluid w-100 gx-5 mb-3 " >
                            <div class="card">
                                <h5 class="card-header bg-dark" style="color: white">Wniosek</h5>
                                <div class="card-body bg-light">
                                    <h5 class="card-title">'.$row["login"].'</h5>
                                    <h6 class="card-text ">Data: '.$row["regist_date"].'</h6>
                                    <div class="container text-center mt-4">
                                            <button type="button" class="btn btn-success w-25" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Akceptować
                                            </button>
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Wniosek o rejestracje - '.$row["login"].'</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                              <div class="modal-body">
                                                                 Na jaki okres udostępnić dostęp ?
                                                                 <div class="text-center mt-3">
                                                                     <select class="form-select mb-3" aria-label=".form-select-lg example">
                                                                        <option selected hidden value="">Open this select menu</option>
                                                                        <option value="day">24 godziny</option>
                                                                        <option value="week">1 tydzień</option>
                                                                        <option value="forewer">Na zawsze</option>
                                                                    </select>
                                                                </div>
                                                              </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary w-25" onclick=document.location="?section=songs&action=delete&id=">Udostępnić</button>
                                                            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Confij</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        
                                        <button class="btn btn-danger w-25">Usunąć</button>
                                    </div>
                                   
                                </div>
                            </div>
                         </div>';

                }
                echo '</div>';
        }
        else{
            echo 'nie ma danych';
        }

        break;
}