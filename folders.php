<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oSong = new Song();
$oFold = new Folder();

switch($action){
    case 'add':
        ?>
    <div class="container w-25" style="min-height: 100vh;">
        <form method="post" action="?section=folders&action=insert" class = "form">
            <div class="mb-3">
                <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowa teczka</h1>
            </div>
            <div class="mb-3">
                <label for="exampleInputText2" class="form-label">Nazwa teczki</label>
                <input type="text" class="form-control" name="name_fold" id="name_fold" required data-validate>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Notatki</span>
                <textarea class="form-control" name="note" aria-label="Notatki"></textarea>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" name="submit"  class="btn btn-dark w-25" value="Dodaj">
            </div>


        </form>
    </div>
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
        <div class="container w-50">
        <a class = "a" href="?section=folders&action=add">Nowa teczka</a><br><br>
        <?php
        if ($aFold->num_rows > 0) {
            echo "<table class='table table-hover table'>";
            echo "<tr><td>Nazwa teczki</td><td>Notatki</td><td></td></tr>";
            while($row = $aFold->fetch_assoc()) {
                $delete = "<a class='c' href = '?section=folders&action=delete&name_folder=".$row["name_folder"]."'>Usunąć</a>";
                echo "<tr><td>".$row["name_folder"]."</td><td>".$row["note"]."</td><td>".$delete."</td></tr>";
            }
            echo "</table>";

        } else {
            echo "Nie ma danych";
        }
        echo '</div>';
        break;
}
