<?php
    print_up_button();
?>

<?php
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
    default:

        break;
}






