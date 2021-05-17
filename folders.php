<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oSong = new Song();
$oFold = new Folder();

switch($action){
    case 'add':
        ?>
        <form method="post" action="?section=folders&action=insert" class = "form">
            <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowa teczka</h1>
                <input type="text" class="edbx" name="name_fold" id="name_fold"
                                            required placeholder="Nazwa teczki*" data-validate><br><br>
                <textarea name = "note" id = "note" placeholder="Notatki"></textarea><br><br>
                <input type="submit" name="submit"  class="btn" value="Dodaj">
        </form>
    <?php
        break;
    case 'insert':
        $name_fold = Get::post('name_fold', '', GET::TYPE_STR);
        $notes = Get::post('note', '', GET::TYPE_STR);

        $oFold->createFolder($name_fold, $notes);
        break;
    case 'delete':
            $name_folder = Get::get('name_folder','',GET::TYPE_STR);
            $aFold = $oFold->deleteFolder($name_folder);
        break;
    default:
        $aFold = $oFold->getAll();
        ?>
        <a class = "a" href="?section=folders&action=add">Nowa teczka</a><br><br>
        <?php
        if ($aFold->num_rows > 0) {
            echo "<table class='table'>";
            echo "<tr><td>Nazwa teczki</td><td>Notatki</td><td></td></tr>";
            while($row = $aFold->fetch_assoc()) {
                $delete = "<a class='c' href = '?section=folders&action=delete&name_folder=".$row["name_folder"]."'>Usunąć</a>";
                echo "<tr><td>".$row["name_folder"]."</td><td>".$row["note"]."</td><td>".$delete."</td></tr>";
            }
            echo "</table>";

        } else {
            echo "Nie ma danych";
        }
        break;
}
