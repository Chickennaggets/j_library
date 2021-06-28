<?php
global $conn;
global $oUser;

$oNews = new News();

$action = Get::get('action', '', GET::TYPE_STR);
switch ($action){
    case 'history':
        require_once CONTENT_FOLDER.'history.html';
        break;
    case 'hoffman':
        require_once CONTENT_FOLDER.'hoffman.html';
        break;
    case 'kontakt':
        require_once CONTENT_FOLDER.'kontakt.html';
        break;
    case 'szulik':
        require_once CONTENT_FOLDER.'szulik.html';
        break;
    case 'mainpage':
        require_once CONTENT_FOLDER.'mainpage.html';
        break;
    case 'post':
        $id = get::GET('id', 0, Get::TYPE_INT);
        echo '<div class="container-fluid text-light gx-5 pt-5 pb-5" style="background-color: rgba(1,1,1, 0.7); min-height: 100vh; width: 100%;">';
        $aNews = $oNews->getById($id);
        echo '
        <div class="container text-center mt-5 mb-3">
            <img src="img/news/'.$aNews["pictures"].'" style="max-width: 1000px">
        </div>
        <div class="container mb-3">
            <h3>'.$aNews["header"].'</h3>
        </div>
        <div class="container mb-3">
            <p align="justify">'.$aNews["post_text"].'</p>
        </div>        ';
        echo '</div>';
        break;
    case 'news':
        echo '<div class="container-fluid text-lg-start gx-5 mt-5 pt-1 pb-5" style="background-color: rgba(1,1,1, 0.7); min-height: 100vh; padding-left: 10px; padding-right: 10px; margin-top: 20px; width: 100%;">';

        $aNews = $oNews->getAll();
        echo '<h1 class="text-light mt-5 text-center">Aktualnośći</h1>';
        echo '<div class="container-fluid mt-5 d-flex justify-content-around flex-wrap align-content-start align-items-start">';

        if($aNews->num_rows > 0){
            while($row = $aNews->fetch_assoc()){
                echo '
                <div class="card m-1 mt-5" style="width: 600px; height: 450px; background-color: rgba(44, 44, 44, 1)">
                    <img src="img/news/'.$row["pictures"].'" style="object-fit: cover" height="300px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-light">'.$row["header"].'</h5>
                         <p class="card-text text-light" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$row["post_text"].'</p>
                         <a href="?section=info&action=post&id='.$row["id_wall"].'" class="btn btn-outline-light">Szczegóły</a>
                    </div>
                </div>
                ';
            }
        }
        echo '</div></div</div>';
        break;
    case '':
        break;
    default:
        require_once CONTENT_FOLDER.'about.html';
        break;
}






