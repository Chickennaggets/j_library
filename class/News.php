<?php


class News
{
    function addPost($header, $post_text, $pictures){
        global $conn;

        $sql = "INSERT INTO wall(header, post_text, pictures)
            values ('$header', $post_text, '$pictures',);";

        if ($conn->query($sql) === TRUE) {
            echo "Dane zostały zaktualizowane<br>";
            echo "<meta http-equiv='refresh' content='1; url=?section=main'>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}