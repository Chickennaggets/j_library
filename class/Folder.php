<?php

class Folder {

    const TABLE = 'folder';

    function getAll() {
        global $conn;

        $sql = "SELECT name_folder, note 
                FROM folder 
                ORDER BY name_folder";

        $result = $conn->query($sql);
        if (!$result->num_rows) {
            return false;
        }

        return $result;
    }
}