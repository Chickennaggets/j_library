<?php

    define('ROOT_FOLDER', '../');

    define('CONFIG_FOLDER', ROOT_FOLDER.'config/');
    define('CLASS_FOLDER', ROOT_FOLDER.'class/');
    define('CONTENT_FOLDER', ROOT_FOLDER.'content/');
    define('TMPL_FOLDER', ROOT_FOLDER . 'tmpl/');
    define('SECTION_FOLDER', ROOT_FOLDER . 'section/');

    define('DB_SERVER', 'localhost');
    define('DB_NAME', 'library');
    define('DB_USER', 'root');
    define('DB_PAS', '');

    define('SC_MAIN_SECTION', 'info');

    $SYS_CONF['public_sections'] = array('info', 'authorization', 'error');
    $SYS_CONF['user_sections']   = array('main', 'songs', 'users', 'news', 'main', 'folders');
