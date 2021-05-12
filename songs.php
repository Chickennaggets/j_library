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
        echo $id;
        $aSong = $oSong->getById($id);
        $aFold = $oFold->getAll();

        if (!$aSong) echo "Nie ma danych"

        ?>

        <div class="regform_d">
            <form method='post' action=?section=songs&action=update&id=<?php echo $aSong["id_song"]; ?> class = 'form'>
                <h1 style='text-align: center; margin: 30px; background-color: transparent;'>Edycja utworu - <?php echo $aSong["name_song"]; ?></h1>
                <input type='text' class='edbx' name='song_name' id='song_name' required placeholder='Nazwa utworu' value='<?php echo $aSong["name_song"]; ?>' data-validate>
                <br><br>
                <input type='number' class='edbx' name='count_p' id='count_p' required placeholder='Ilość partytur' value='<?php echo $aSong["count"]; ?>' data-validate>
                <br><br>
                <input type='text' class='edbx' name='autor' id='autor' required placeholder='Autor*' value='<?php echo $aSong["author"]; ?>' data-validate>
                <br><br>
                <textarea class='edbx' name='notatki' id='notatki' placeholder='Notatki*' data-validate><?php echo $aSong["note"]; ?></textarea>
                <br><br>
                Numer teczki: <label><?php echo $aSong["id_song"]; ?></label><br><br>
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
        $count_p = Get::post('count_p', '', GET::TYPE_INT);
        $autor = Get::post('autor', '', GET::TYPE_STR);
        $folders = Get::post('folders', '', GET::TYPE_STR);
        $notatki = Get::post('notatki', '', GET::TYPE_STR);
        $id = Get::post('id', 0, GET::TYPE_INT);

        $oSong->updateSong($song_name, $count_p, $autor, $folders, $notatki, $id);

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
            echo "<br><br><a class = 'a' href=?section=delete_song_sql&id=".$aSong["id_song"].">Usunąć utwór</a>";
        }
}