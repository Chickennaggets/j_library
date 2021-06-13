<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oSong = new Song();
$oFold = new Folder();

switch($action) {
    case 'edit' :
        $id = get::GET('id', 0, Get::TYPE_INT);
        $aSong = $oSong->getById($id);
        $aFold = $oFold->getAll();

        if (!$aSong)
            echo "Nie ma danych";
        ?>

        <div class="regform_d">
            <form method='post' action='?section=songs&action=update' class = 'form'>
                <h1 style='text-align: center; margin: 30px; background-color: transparent;'>Edycja utworu - <?php echo $aSong["name_song"]; ?></h1>
                <input type='text' class='edbx' name='song_name' id='song_name' required placeholder='Nazwa utworu' value='<?php echo $aSong["name_song"]; ?>' data-validate>
                <br><br>
                <input type='number' class='edbx' name='count_p' id='count_p' required placeholder='Ilość partytur' value='<?php echo $aSong["count"]; ?>' data-validate>
                <br><br>
                <input type='text' class='edbx' name='autor' id='autor' required placeholder='Autor*' value='<?php echo $aSong["author"]; ?>' data-validate>
                <br><br>
                <textarea class='edbx' name='notatki' id='notatki' placeholder='Notatki*' data-validate><?php echo $aSong["note"]; ?></textarea>
                <br><br>
                <input type="hidden" name="n_teczki" value=<?php echo $aSong["id_song"]; ?> />
                Numer teczki: <label ><?php echo $aSong["id_song"]; ?></label><br><br>
                <?php
                if ($aFold) {
                    echo "Teczka <select class = 'edbx' name='folders' id='folders'>";
                    while($row = $aFold->fetch_assoc()) {
                        echo "<option value='".$row["id_folder"]."'>".$row["name_folder"]."</option>";
                    }
                    echo "</select><br><br>";
                } else {
                    echo "Nie ma danych";
                }
                ?>
                <input type="submit" name="submit"  class="btn" value="Zachowaj">
            </form>
        </div>
    <?php
    break;
    case 'update':

        $song_name = Get::post('song_name', '', GET::TYPE_STR);
        $count_p = Get::post('count_p', 0, GET::TYPE_INT);
        $autor = Get::post('autor', '', GET::TYPE_STR);
        $folders = Get::post('folders', 0, GET::TYPE_INT);
        $notatki = Get::post('notatki', '', GET::TYPE_STR);
        $id = Get::post('n_teczki', 0, GET::TYPE_INT);

        $oSong->updateSong($song_name, $count_p, $autor, $folders, $notatki, $id);

        break;
    case 'delete':
        $id = get::GET('id', 0, Get::TYPE_INT);
        $oSong ->deleteSong($id);

        break;

    case 'add':

        $aFold = $oFold->getAll();

        ?>
            <div class="container-fluid d-flex flex-fill bd-highlight justify-content-center align-items-center h-100 pt-5" style="width: 500px;">
                <form method="post" action="?section=songs&action=insert">
                    <h2 class="mb-4 text-center">Nowy utwór</h2>
                    <div class="mb-3">
                        <label for="exampleInputText1" class="form-label">Nazwa utworu</label>
                        <input type="text" required class="form-control" name="song_name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText2" class="form-label">Ilość partytur</label>
                        <input type="number" required class="form-control" name="count_p">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText3" class="form-label">Autor</label>
                        <input type="text" required class="form-control" name="autor">
                    </div>
                    <div class="mb-3">
                        <?php
                        if ($aFold) {
                            echo '<select class="form-select" name="folders" aria-label="Default select example"><option value="5" hidden selected>Wybierz teczkę</option>';
                            while($row = $aFold->fetch_assoc()) {
                                echo "<option value='".$row["id_folder"]."'>".$row["name_folder"]."</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "Nie ma danych";
                        }
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Notatki</span>
                        <textarea class="form-control" name="notatki" aria-label="Notatki"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="container-fluid" style="text-align: center">
                            <button type="submit" class="btn btn-primary w-50">Dodaj</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        break;

    case 'insert':
        $song_name = Get::post('song_name', '', GET::TYPE_STR);
        $count_p = Get::post('count_p', 0, GET::TYPE_INT);
        $autor = Get::post('autor', '', GET::TYPE_STR);
        $folders = Get::post('folders', 0, GET::TYPE_INT);
        $notatki = Get::post('notatki', '', GET::TYPE_STR);

        $oSong->addSong($song_name,$count_p,$autor,$folders,$notatki);

        break;

    case 'search':
        $parameter = Get::get('parameter', '', GET::TYPE_STR);
        $word = Get::get('word', '', GET::TYPE_STR);

        $aSong = $oSong->searchSongs($parameter, $word);

        if ($aSong) {
            echo "<div class='container gx-3' style='min-height: 100vh';><table class='table table-hover'>";
            echo "<tr>
                        <td>Numer teczki</td>
                        <td>Nazwa utworu</td>
                        <td>Ilość partytur</td>
                        <td>Autor</td>
                        <td>Nazwa teczki</td>
                  </tr>";
            while ($row = $aSong->fetch_assoc()) {
                echo "<tr><td>" . $row["id_song"] . "</td>
                          <td><a class = 'a' href='?section=songs&id=" . $row["id_song"] . "'>" . $row["name_song"] . "</a></td>
                          <td>" . $row["count"] . "</td>
                          <td>" . $row["author"] . "</td>
                          <td>" . $row["name_folder"] . "</td>
                     </tr>";
            }
            echo "</table></div>";
        }
        break;
    case 'uploadfile':
        $id_folder = Get::post('id_folder', '', GET::TYPE_STR);
        $folderName = getNameFolder($id_folder);
        if(!is_dir(ROOT_FOLDER.'/files/'.$folderName)) {
            mkdir(ROOT_FOLDER.'/files/'.$folderName, 0700);
        }
        if(!is_dir(ROOT_FOLDER.'/files/'.$folderName.'/'.$id_folder)) {
            mkdir(ROOT_FOLDER.'/files/'.$folderName.'/'.$id_folder, 0700);
        }
        if(move_uploaded_file($_FILES['filename']['tmp_name'], ROOT_FOLDER.'/files/'.$folderName.'/'.$id_folder.'/'.$_FILES['filename']['name'])){
            echo 'File was uploaded';
        }
        else{
            echo 'File is not uploaded';
        }

        break;
    default:
        $id = get::GET('id', 0, Get::TYPE_INT);
        $aSong = $oSong->getById($id);

        if (!$aSong) {
            echo "Nie ma danych";
        }
        echo '<div class="container-fluid p-5 gx-0" style="margin-top: 50px;">';
        if($oUser->isAdmin()){
            echo "<div style='float: right;'>
                      <a href='?section=songs&action=edit&id=".$aSong["id_song"]."'>Edycja</a>
                      <a href='?section=songs&action=delete&id=".$aSong["id_song"]."'>Usunąć</a>
                  </div>";


        }
        echo "<h1 align='center' style='margin-bottom: 60px'>".$aSong["name_song"]."</h1>";

        echo "<div class='container-fluid w-50'>
                  <p>Numer teczki: ".$aSong["id_song"]."</p>
                  <p>Ilość partytur: ".$aSong["count"]."</p>
                  <p>Autor: ".$aSong["author"]."</p>
                  <p>Teczka: ".$aSong["name_folder"]."</p>
                  <p>Notatki:<br> ".$aSong["note"]."</p></div>";
        $folderName = getNameFolder($id);
        $dir = ROOT_FOLDER.'/files/'.$folderName.'/'.$id.'/';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                echo '<div class="container-fluid w-50 p-3"><table class="table table-hover"><tr>Pliki:</tr>';
                while (false !== ($file = readdir($dh))) {
                    if($file!="." && $file != "..")
                        echo "<tr><td>".$file." <a style='float:right' class='a' href='".$dir."/".$file."' download=''>Pobierz</a><a class='a' style='float:right' href='".$dir."/".$file."'>Otwórz</a></td></tr>";
                }
                echo '</div></table>';
                closedir($dh);
            }
        }



        if ($oUser->isAdmin()) {
            echo '<div class="container-fluid w-50">
                      <div class="mb-3 lg-3">
                          <form action="?section=songs&action=uploadfile" method="post" enctype="multipart/form-data" style="margin-top: 30px; text-align: center;">
                              <label for="formFile" class="form-label">Wgraj pliki</label>
                              <input type="text" name="id_folder" value="'.$id.'" hidden>
                              <input class="form-control" type="file" aria-label="browser" name="filename" id="formFile">
                              <button type="submit" class="btn btn-primary w-50 mt-3">Wyślij</button>
                          </form>
                      </div>
                  </div>';
        }
        echo "</div>";
        break;
}