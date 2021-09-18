<?php

class Folder {

    const TABLE = 'folder';

    /**
     * @return bool|mysqli_result
     */
    function getAll() {
        global $conn;

        $sql = "SELECT id_folder, name_folder, note 
                FROM folder 
                ORDER BY name_folder";

        $result = $conn->query($sql);
        if (!$result->num_rows) {
            return false;
        }
        return $result;
    }

    /**
     * @param $name_folder - name folder
     */
    function deleteFolder($name_folder){
        global $conn;

        $sql = "DELETE FROM folder 
        WHERE name_folder='$name_folder';";

        if ($conn->query($sql) === TRUE) {
            header('Location: ?section=folders');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<br><br><br>Nie da się usunąć teczki w której są utwory ! Najperw trzeba pousuwać utwory znajdujące się w tej teczce, albo przenieść utwory w inne teczki.<br><br>";
            echo "<a href='?section=folders' class='a'>Cofnij</a>";
        }
    }

    /**
     * @param $name_fold - name folder
     * @param $notes - notes
     */
    function createFolder($name_fold, $notes){
        global $conn;

        $sql = "INSERT INTO folder(name_folder, note) 
            VALUES ('$name_fold', '$notes');";

        if ($conn->query($sql) === TRUE) {
            echo "Teczka dodana<br>";
            header('Location: ?section=folders');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<br><br>Możliwe że taka teczka już istnieje.";
            echo "<br><a href='?section=folders' class='a'>Cofnij</a>";
        }
    }
}