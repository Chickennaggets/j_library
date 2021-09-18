<?php

class Song {

    const TABLE = 'songs';

    /**
     * @param $id
     * @return array|false|null
     */
    function getById($id) {
        global $conn;

        $sql = "SELECT id_song, name_song, count, author, song.id_folder, folder.name_folder, song.note 
            FROM song 
              LEFT JOIN folder ON song.id_folder = folder.id_folder 
            WHERE id_song = ".$id;
        $result = $conn->query($sql);
        if (!$result->num_rows) {
            return false;
        }

        return $result->fetch_assoc();
    }

    /**
     * @param $song_name
     * @param $count_p
     * @param $autor
     * @param $folders
     * @param $notatki
     * @param $id
     */
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
            header('Location: ?section=main');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    /**
     * @param $id
     */
    function deleteSong($id){
        global $conn;

        $sql = "DELETE FROM song 
        WHERE id_song=$id";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=main');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    /**
     * @param $song_name
     * @param $count_p
     * @param $autor
     * @param $folders
     * @param $notatki
     */
    function addSong($song_name, $count_p, $autor, $folders, $notatki){
        global $conn;

        $sql = "INSERT INTO song(name_song, count, author, id_folder, note)
            values ('$song_name', $count_p, '$autor', $folders, '$notatki');";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=main');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    /**
     * @param $parameter
     * @param $word
     * @return bool|mysqli_result
     */
    function searchSongs($parameter, $word){
        global $conn;

        $sql = "SELECT id_song, name_song, count, author, folder.name_folder
                    FROM song 
                        LEFT JOIN folder ON song.id_folder = folder.id_folder
                            WHERE name_song LIKE '%".$word."%' OR author LIKE '%".$word."%'
                                ORDER BY ".$parameter." ";

        $result = $conn->query($sql);

        if ($result) {
            return $result;
        }
        return false;
    }
}