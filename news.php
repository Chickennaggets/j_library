<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oNews = new News();

switch($action) {
    case 'insert':
        $header = Get::post('header', '', GET::TYPE_STR);
        $post_text = Get::post('post_text', '', GET::TYPE_STR);
        $pictures = Get::post('pictures', '', GET::TYPE_STR);

        $oNews->addPost($header,$post_text,$pictures);

        break;


}