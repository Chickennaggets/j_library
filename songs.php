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
                        <button type="submit" class="btn btn-dark w-25">Zapisz</button>
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
                            <button type="submit" class="btn btn-dark w-25">Dodaj</button>
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
        $_SESSION["song_sort"] = $parameter;
        $aSong = $oSong->searchSongs($parameter, $word);

        if ($aSong) {
            echo "<div class='container gx-3' style='min-height: 100vh';><table class='table table-hover'>";
            echo "<tr>";
            if(!$oUser->isGuest()){ echo '<td>Numer teczki</td>';}
            echo            '<td>Nazwa utworu</td>';
            if($oUser->isAdmin()){ echo '<td>Ilość partytur</td>';}
            echo            '<td>Autor</td>';
             if(!$oUser->isGuest()){ echo '<td>Nazwa teczki</td>'; }
             echo "   </tr>";
            while ($row = $aSong->fetch_assoc()) {
                echo '<tr>';
                if (!$oUser->isGuest()) {
                    echo '        <td>' . $row["id_song"] . '</td>'; }
                    echo '<td><a href="?section=songs&id=' . $row["id_song"] . '" > ' . $row["name_song"] . '</a></td>';
                    if ($oUser->isAdmin()) {
                        echo '   <td>' . $row["count"] . '</td>';
                    }
                    echo '<td>' . $row["author"] . '</td>';
                    if (!$oUser->isGuest()) {
                        echo '<td>' . $row["name_folder"] . '</td>';
                    }
                    echo '  </tr>';
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
        /*if(move_uploaded_file($_FILES['filename']['tmp_name'], ROOT_FOLDER.'/files/'.$folderName.'/'.$id_folder.'/'.$_FILES['filename']['name'])){
            echo 'File was uploaded';
        }
        else{
            echo 'File is not uploaded';
        }*/

        if( isset($_FILES['filename']['name'])) {

            $total_files = count($_FILES['filename']['name']);

            for($key = 0; $key < $total_files; $key++) {

                if(isset($_FILES['filename']['name'][$key])
                    && $_FILES['filename']['size'][$key] > 0) {

                    $original_filename = $_FILES['filename']['name'][$key];
                    $target = ROOT_FOLDER.'/files/'.$folderName.'/'.$id_folder.'/'.$_FILES['filename']['name'] . basename($original_filename);
                    $tmp  = $_FILES['filename']['tmp_name'][$key];
                    move_uploaded_file($tmp, $target);
                }

            }

        }

        header('Location: ?section=songs&id='.$id_folder);
        break;
    case 'deletefile':
        $id = get::GET('id', 0, Get::TYPE_INT);
        $path = get::GET('path', '', Get::TYPE_STR);
        if(unlink($path)){
            echo "file was deleted";
        }
        else{
            echo "file was not deleted";
        }
        header('Location: ?section=songs&id='.$id);
        break;

    case 'guestdownload':
        $dir = get::GET('folder', '', Get::TYPE_STR);
        $utwor = get::GET('utwor', '', Get::TYPE_STR);

        if($oUser->getCountDownloads($_SESSION["online_login"])>0){
            if ($dh = opendir($dir)) {

                $zip = new ZipArchive();
                $filename = $utwor.".zip";

                if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
                    exit("Невозможно открыть <$filename>\n");
                }

                while (false !== ($file = readdir($dh))) {
                    if ($file != "." && $file != "..") {
                        $filePath = $dir.$file;
                        $zip->addFile($filePath,$file);
                    }
                }

                $zip->close();
                $oUser->setCountDownloads($_SESSION["online_login"], $oUser->getCountDownloads($_SESSION["online_login"])-1);
                DownloadFile($filename);
                exit;
            }
        }
        else{
            header('location: index.php');
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
            
  
            <button class="btn" onclick=document.location="?section=songs&action=edit&id='.$aSong["id_song"].'">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                     <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
            </button>
            
            
            <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
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

        echo "<div class='container-fluid w-50'>";
        if(!$oUser->isGuest()){ echo "<h5 class='mb-3'>Numer teczki: ".$aSong["id_song"]."</h5>"; }
        if(!$oUser->isGuest()){ echo "<h5 class='mb-3'>Ilość partytur: ".$aSong["count"]."</h5>"; }
        echo "<h5 class='mb-3'>Autor: ".$aSong["author"]."</h5>";
        if(!$oUser->isGuest()){ echo "<h5 class='mb-3'>Teczka: ".$aSong["name_folder"]."</h5>"; }
        if(!$oUser->isGuest()){ echo " <h5 class='mb-3'>Notatki:</h5>".$aSong["note"]; }
        echo "</div>";
        $folderName = getNameFolder($id);
        $dir = ROOT_FOLDER.'/files/'.$folderName.'/'.$id.'/';
        if (is_dir($dir)) {
            if(!$oUser->isGuest()) {
                if ($dh = opendir($dir)) {
                    echo '<div class="container-fluid w-50 pt-3"><table class="table table-hover"><tr><h5>Pliki:</h5></tr>';
                    while (false !== ($file = readdir($dh))) {
                        if ($file != "." && $file != "..") {
                            $path = $dir . '/' . $file;
                            echo "<tr><td>"
                                . $file;
                            echo '<div style="float: right">
                                 <a href="' . $dir . '/' . $file . '" style="color: black; margin-right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                 </a>
                                 <a href="' . $dir . '/' . $file . '" download="" style="color: black; margin-right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                 </a>';
                            if($oUser->isAdmin()){
                                echo '<a type="button" data-bs-toggle="modal" data-bs-target="#delfile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                    <div class="modal fade" id="delfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel1">Napewno chcesz usunąć ten plik ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                <a class="btn btn-dark w-25" href="?section=songs&action=deletefile&path=' . $path . '&id=' . $aSong["id_song"] . '">Tak</a>
                                                    <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Nie</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                                 echo '
                               </div>
                             </td></tr>';
                        }
                    }
                    echo '</table></div>';
                    closedir($dh);
                }
            }
            else{ // для гостя
                if ($dh = opendir($dir)) {
                    $issetfiles = false;
                    echo '<div class="container-fluid w-50 pt-3"><table class="table table-hover"><tr><h5>Pliki:</h5></tr>';
                    while (false !== ($file = readdir($dh))) {
                        if ($file != "." && $file != "..") {
                            echo '<tr><td>'.$file.'</td></tr>';
                            $issetfiles = true;
                        }
                    }
                    echo '</table>';
                    if($oUser->getCountDownloads($_SESSION["online_login"])==0){
                        $stat = 'disabled';
                    }
                    else{
                        $stat = '';
                    }
                    if($issetfiles)
                    echo '<!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-dark px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Pobrać pliki
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Uwaga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Napewno chcęsz pobrać te pliki ?<br>
                    Masz teraz
        ';
        echo $oUser->getCountDownloads($_SESSION["online_login"]);
                    echo' pobrań.
                  </div>
                  <div class="modal-footer">
                    <a href="?section=songs&action=guestdownload&folder='.$dir.'&utwor='.$aSong["name_song"].'" class="btn '.$stat.' btn-outline-dark px-3">Pobrać</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Confnij</button>
                  </div>
                </div>
              </div>
            </div>';
                    echo '</div>';
                }

            }
        }
        if ($oUser->isAdmin()) {
            echo '<div class="container-fluid d-flex flex-column justify-content-center w-50">
                      <div class="mb-3 lg-3">
                          <form action="?section=songs&action=uploadfile" method="post" class="" enctype="multipart/form-data" style="margin-top: 30px;">
                          <div class="container-fluid mb-3">
                              <label for="formFile" class="form-label">Wgraj plik</label>
                              <input type="text" name="id_folder" value="'.$id.'" hidden>
                              <input class="form-control" type="file" multiple accept=".wav,.pdf,.mp3" aria-label="browser" name="filename[]" id="formFile">
                          </div>
                          <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark px-3 mt-3">Wyślij</button>
                          </div>
                          </form>
                      </div>
                  </div>';
        }
        echo '</div></div>';
        break;
}