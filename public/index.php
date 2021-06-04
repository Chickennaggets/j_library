<?php
include '../config/config.php';
include CONFIG_FOLDER.'common_config.php';

global $oUser;

$section = Get::get('section', 'main', Get::TYPE_STR);
if($section=='authorization' && $oUser->isLogin()){
    $section = 'main';
}

//$section = $oUser->isLogin() ? $section : 'authorization';

if(!faceControle($section)){
    echo 'No way';
    $section='error?text=No_way';
}


if (isset($_GET['ajax'])) {
    include_once ROOT_FOLDER.$section.'.php';
} else {
    if(in_array($section, array('info'))) {
        include_once ROOT_FOLDER. 'main_template.php';
    }
    else{
        include_once ROOT_FOLDER . 'lib_template.php';
    }
}

