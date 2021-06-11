<?php


class Tmpl {

    function __construct() {

    }

    static function getTmpl($tmpl, $data, $section = '') {
        $content = '';

        $folder = TMPL_FOLDER . ($section ? $section . '/' : '');
        $file = $folder . $tmpl . '.html';

        if  (file_exists($file)) {
            $content = file_get_contents($folder . $tmpl . '.html');

            foreach($data AS $key => $value){
                $content = str_replace('{{'.$key.'}}', $value, $content);
            }
        }

        return $content;
    }
}