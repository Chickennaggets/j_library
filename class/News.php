<?php


class News
{
    function addPost($header, $post_text, $picture){
        global $conn;

        $sql = "INSERT INTO wall(header, post_text, pictures)
            values ('$header', '$post_text', '$picture');";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            header('Location: ?section=news');
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
            WHERE id_wall = $id;";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            header('Location: ?section=news');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    function deletePost($id){
        global $conn;

        $sql = "DELETE FROM wall 
        WHERE id_wall=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Utwór został usunięty<br>";
            header('Location: ?section=news');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}
