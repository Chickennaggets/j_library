<?php
include '../config/config.php';
include CONFIG_FOLDER.'common_config.php';

global $oUser;

$section = Get::get('section', 'main', Get::TYPE_STR);
if($section=='authorization' && $oUser->isLogin()){
    $section = 'main';
}

if (isset($_GET['ajax'])) {
    include_once ROOT_FOLDER.$section.'.php';
} else {
    if(in_array($section, array('info'))) {
        include_once ROOT_FOLDER. 'main_template.php';
    }
    else{
        if(faceControle($section))
            include_once ROOT_FOLDER . 'lib_template.php';
        else
            echo "ERROR";
    }
}






