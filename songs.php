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
        <div class="regform_d">
            <form method="post" action="?section=songs&action=insert" class = "form">
                 <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowy utwór</h1>
                      <input type="text" class="edbx" name="song_name" id="song_name"
                                                                required placeholder="Nazwa utworu*" data-validate><br><br>
                           <input type="number" class="edbx" name="count_p" id="count_p"
                                                                required placeholder="Ilość partytur*" data-validate><br><br>
                                <input type="text" class="edbx" name="autor" id="autor"
                                                                required placeholder="Autor" data-validate><br><br>
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

                                        <textarea name="notatki" id="notatki" placeholder="Notatki"></textarea><br><br>
                                        <input type="submit" name="submit" class="btn" value="Dodaj">
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
            echo "<table class='table'>";
            echo "<tr class='anim_tr'>
                        <td>Numer teczki</td>
                        <td>Nazwa utworu</td>
                        <td>Ilość partytur</td>
                        <td>Autor</td>
                        <td>Nazwa teczki</td>
                  </tr>";
            while ($row = $aSong->fetch_assoc()) {
                echo "<tr class='anim_tr'><td>" . $row["id_song"] . "</td>
                          <td><a class = 'a' href='?section=songs&id=" . $row["id_song"] . "'>" . $row["name_song"] . "</a></td>
                          <td>" . $row["count"] . "</td>
                          <td>" . $row["author"] . "</td>
                          <td>" . $row["name_folder"] . "</td>
                     </tr>";
            }
            echo "</table>";
        ?>
            <a id="upbutton" href="#" onclick="smoothJumpUp(); return false;">
                <img src="img/up.png" alt="Top" border="none" title="Do góry">
            </a>
        <?php
        } else {
            echo "Nie ma danych";
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
        if($oUser->isAdmin()){
            echo "<div style='float: right;'>
                      <a href='?section=songs&action=edit&id=".$aSong["id_song"]."'><img src='img/icons/edit.png' class='icon' alt='Edycja' title='Edytować'></a>
                      <a href='?section=songs&action=delete&id=".$aSong["id_song"]."'><img src='img/icons/delete.png' class='icon' alt='Usunąć' title='Usunąć'></a>
                  </div>";


        }
        echo "<h1 align='center' style='margin-bottom: 60px'>".$aSong["name_song"]."</h1>";

        echo "<div class='main_part'><div class='left_part'>
                  <p>Numer teczki: ".$aSong["id_song"]."</p>
                  <p>Ilość partytur: ".$aSong["count"]."</p>
                  <p>Autor: ".$aSong["author"]."</p>
                  <p>Teczka: ".$aSong["name_folder"]."</p>
                  <p>Notatki:<br> ".$aSong["note"]."</p>
             </div>
          <div class='right_part'><p>Pliki:</p>";
        $folderName = getNameFolder($id);
        $dir = ROOT_FOLDER.'/files/'.$folderName.'/'.$id.'/';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (false !== ($file = readdir($dh))) {
                    if($file!="." && $file != "..")
                        echo "<div class='file'>".$file." <a style='float:right' class='a' href='".$dir."/".$file."' download=''><img src='img/icons/download.png' class='icon' title='Pobierz'></a><a class='a' style='float:right' href='".$dir."/".$file."'><img src='img/icons/openfile.png' class='icon' title='Otwórz'></a><br></div>";
                }
                closedir($dh);
            }
        }
          echo "";


        if ($oUser->isAdmin()) {
            echo '<div class="upl_form">
            <form action="?section=songs&action=uploadfile" method="post" enctype="multipart/form-data" style="margin-top: 30px; text-align: center;">
                <input type="text" name="id_folder" value="'.$id.'" hidden>
                <input type="file" class="inp_tp_file" aria-label="browser" name="filename"><br><br>
                <input type="submit" class="btn">
            </form></div>
            ';
        }
        echo '</div></div>';
        break;
}