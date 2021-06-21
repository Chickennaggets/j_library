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
    case 'news':
        echo '<div class="container-fluid text-lg-start gx-5 mt-5 pt-1 pb-5" style="background-color: rgba(1,1,1, 0.7); min-height: 100vh; padding-left: 10px; padding-right: 10px; margin-top: 20px; width: 100%;">';

        $aNews = $oNews->getAll();
        echo '<h1 class=" mt-5 text-light text-center">Aktualnośći</h1>';
        echo '<div class="container-fluid mt-5 text-light d-flex justify-content-between flex-wrap align-content-start align-items-start">';

        if($aNews->num_rows > 0){
            while($row = $aNews->fetch_assoc()){
                echo '
                <div class="card bg-dark m-1 mt-5" style="width: 450px; height: auto;">
                    <img src="img/news/'.$row["pictures"].'" style="object-fit: cover" height="250px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="#" class="btn text-light"><h5 class="card-title">'.$row["header"].'</h5></a>
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






