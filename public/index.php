<?php
include '../config/config.php';
include CONFIG_FOLDER.'common_config.php';

global $oUser;

$section = Get::get('section', SC_MAIN_SECTION, Get::TYPE_STR); //if main for authorize users, can't be default
$section = faceControle($section);

if (Get::get('ajax', false, Get::TYPE_ISSET)) {
    include_once SECTION_FOLDER . $section . '.php';
} else {
    include_once TMPL_FOLDER . main_template($section);
}








