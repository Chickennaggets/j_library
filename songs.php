<?php
//require_once CLASS_FOLDER.'Song.php';

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
    default:
        $id = get::GET('id', 0, Get::TYPE_INT);
        $aSong = $oSong->getById($id);

        if (!$aSong) {
            echo "Nie ma danych";
        }

        echo "<h1 align='center'>".$aSong["name_song"]."</h1><br><br><br><br>";
        echo "<h2>Numer teczki: ".$aSong["id_song"]."<br><hr>Ilość partytur: ".$aSong["count"]."<br>
          <hr>Autor: ".$aSong["author"]."<br>
          <hr>Teczka: ".$aSong["name_folder"]."<br>
          <hr>Notatki: ".$aSong["note"]."</h2>";
        if ($oUser->isLogin()) {
            echo "<br><br><br><a class = 'a' href=?section=songs&action=edit&id=".$aSong["id_song"].">Edycja</a>";
            echo "<br><br><a class = 'a' href=?section=songs&action=delete&id=".$aSong["id_song"].">Usunąć utwór</a>";
        }
}