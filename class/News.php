<?php


class News
{
    function addPost($header, $post_text){
        global $conn;

        $sql = "INSERT INTO wall(header, post_text)
            values ('$header', '$post_text');";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            echo "<meta http-equiv='refresh' content='1; url=?section=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    function getAll(){
        global $conn;

        $sql = "SELECT * 
                FROM wall";

        $result = $conn->query($sql);

        if ($result) {
            return $result;
        }
        return false;
    }
    function getById($id){
        global $conn;

        $sql = "SELECT *
                FROM wall
                WHERE id_wall=".$id;
        $result = $conn->query($sql);
        if (!$result->num_rows) {
            return false;
        }

        return $result->fetch_assoc();

    }
    function editPost($id, $header, $text){
        global $conn;

        $sql = "UPDATE wall 
            SET 
                header = '$header', 
                post_text = '$text'
            WHERE id_wall = '$id';";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            //echo "<meta http-equiv='refresh' content='1; url=?section=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}
