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
        <div class="container-fluid d-flex flex-fill bd-highlight justify-content-center align-items-center h-auto" style="width: 500px; min-height: 100vh">
            <form method="post" action="?section=songs&action=update">
                <h2 class="mb-4 text-center">Edycja utworu - <?php echo $aSong["name_song"]; ?></h2>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Nazwa utworu</label>
                    <input type="text" required class="form-control" name="song_name" value='<?php echo $aSong["name_song"]; ?>'>
                </div>
                <div class="mb-3">
                    <label for="exampleInputText2" class="form-label">Ilość partytur</label>
                    <input type="number" required class="form-control" name="count_p" value='<?php echo $aSong["count"]; ?>'>
                </div>
                <div class="mb-3">
                    <label for="exampleInputText3" class="form-label">Autor</label>
                    <input type="text" required class="form-control" name="autor" value='<?php echo $aSong["author"]; ?>'>
                </div>
                <div class="mb-3">
                    <input type="hidden" name="n_teczki" value=<?php echo $aSong["id_song"]; ?> />
                    Numer teczki: <label ><?php echo $aSong["id_song"]; ?></label>
                </div>
                <div class="mb-3">
                    <?php
                    if ($aFold) {
                        echo '<select class="form-select" name="folders" aria-label="Default select example"><option value="'.$aSong["id_folder"].'" hidden selected>'.$aSong["name_folder"].'</option>';
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
                    <textarea class="form-control" name="notatki" aria-label="Notatki"><?php echo $aSong["note"]; ?></textarea>
                </div>
                <div class="mb-3">
                    <div class="container-fluid" style="text-align: center">
                        <button type="submit" class="btn btn-primary w-25">Zapisz</button>
                    </div>
                </div>
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
            <div class="container-fluid pt-5" style="width: 500px; min-height: 100vh">
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
                            <button type="submit" class="btn btn-primary w-25">Dodaj</button>
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
        echo '<div class="container-fluid p-3 gx-0" style="min-height: 100vh">';
        if($oUser->isAdmin()){
            echo '
            <div style="float: right;">
            <a href="?section=songs&action=edit&id='.$aSong["id_song"].'">Edycja</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Usunąć
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Napewno chcesz usunąć ten utwór ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary w-25" onclick=document.location="?section=songs&action=delete&id='.$aSong["id_song"].'">Tak</button>
                            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Nie</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        }
        echo "<h2 align='center' style='margin-bottom: 60px'>".$aSong["name_song"]."</h2>";

        echo "<div class='container-fluid w-50'>
                  <h5>Numer teczki: ".$aSong["id_song"]."</h5>
                  <h5>Ilość partytur: ".$aSong["count"]."</h5>
                  <h5>Autor: ".$aSong["author"]."</h5>
                  <h5>Teczka: ".$aSong["name_folder"]."</h5>
                  <h5>Notatki:</h5>".$aSong["note"]."</div>";
        $folderName = getNameFolder($id);
        $dir = ROOT_FOLDER.'/files/'.$folderName.'/'.$id.'/';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                echo '<div class="container-fluid w-50 pt-3"><table class="table table-hover"><tr><h5>Pliki:</h5></tr>';
                while (false !== ($file = readdir($dh))) {
                    if($file!="." && $file != "..")
                        echo "<tr><td>".$file."<a style='float:right' class='a' href='".$dir."/".$file."' download=''>Pobierz</a><a class='a' style='float:right' href='".$dir."/".$file."'>Otwórz</a></td></tr>";
                }
                echo '</table></div>';
                closedir($dh);
            }
        }
        if ($oUser->isAdmin()) {
            echo '<div class="container-fluid d-flex flex-column justify-content-center w-50">
                      <div class="mb-3 lg-3">
                          <form action="?section=songs&action=uploadfile" method="post" class="" enctype="multipart/form-data" style="margin-top: 30px;">
                          <div class="container w-50 mb-3 text-center">
                              <label for="formFile" class="form-label">Wgraj pliki</label>
                              <input type="text" name="id_folder" value="'.$id.'" hidden>
                              <input class="form-control" type="file" aria-label="browser" name="filename" id="formFile">
                          </div>
                          <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-25 mt-3">Wyślij</button>
                          </div>
                          </form>
                      </div>
                  </div>';
        }
        echo '</div></div>';
        break;
}