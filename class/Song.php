<?php

class Song {

    const TABLE = 'songs';

    function getById($id) {
        global $conn;

        $sql = "SELECT id_song, name_song, count, author, folder.name_folder, song.note 
            FROM song 
              LEFT JOIN folder ON song.id_folder = folder.id_folder 
            WHERE id_song = ".$id;
        $result = $conn->query($sql);
        if (!$result->num_rows) {
            return false;
        }

        return $result->fetch_assoc();
    }

    function updateSong($song_name, $count_p, $autor, $folders, $notatki, $id){
        global $conn;

        $sql = "UPDATE song 
            SET 
                name_song = '$song_name', 
                count = '$count_p', 
                author = '$autor', 
                id_folder = '$folders', 
                note = '$notatki' 
            WHERE id_song = $id;";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            echo "<meta http-equiv='refresh' content='1; url=?section=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function deleteSong($id){
        global $conn;

        $sql = "DELETE FROM song 
        WHERE id_song=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Utwór został usunięty<br>";
            echo "<meta http-equiv='refresh' content='1; url=?section=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}