<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oNews = new News();

switch($action) {
    case 'new_post':
        ?>
    <div class="regform_d">
        <form action="?section=news&action=insert" style="text-align: center;" method="post">
            <h2>Aktualności - nowy zapis</h2><br>
            <input type="text" class="edbx" required placeholder="Zagłówek" name = "header"><br><br>
            <textarea name="post_text" required placeholder="Tekst"></textarea><br><br>
            <input type="submit" class="btn" value="Zapisz">
        </form>
    </div>

    <?php
        break;
    case 'insert':
        $header = Get::post('header', '', GET::TYPE_STR);
        $post_text = Get::post('post_text', '', GET::TYPE_STR);
        //$pictures = Get::post('pictures', '', GET::TYPE_STR);

        $oNews->addPost($header,$post_text);

        break;
    case 'edit':
        $id = get::GET('id', 0, Get::TYPE_INT);

        $aNews = $oNews->getById($id);

        ?>
        <div class="regform_d">
            <form action="?section=news&action=update" style="text-align: center;" method="post">
                <h2>Aktualności - Edycja</h2><br>
                <input type="text" hidden name="id" value="<?php echo $id; ?>">
                <input type="text" class="edbx" placeholder="Zagłówek" required  name = "header" value="<?php echo $aNews["header"]; ?>"><br><br>
                <textarea name="post_text" required  placeholder="Tekst"><?php echo $aNews["post_text"]; ?></textarea><br><br>
                <input type="submit" class="btn" value="Zapisz">
            </form>
        </div>
        <?php
        break;
    case 'update':

        $id = Get::post('id', '', GET::TYPE_INT);
        $header = Get::post('header', '', GET::TYPE_STR);
        $text = Get::post('post_text', '', GET::TYPE_STR);

        $oNews->editPost($id, $header, $text);
        break;
    case 'delete':
        $id = Get::get('id', '', GET::TYPE_INT);
        $oNews->deletePost($id);
        break;
    default:
        echo '<a href="?section=news&action=new_post" class="a"><div class="nav_part" style="font-size: 17px; width: 200px;"><img src="img/icons/newfile.png" class="icon"><div class="n_text">Nowy zapis</div></div></a><hr>';
        $aNews = $oNews->getAll();

        if($aNews->num_rows > 0){
            while($row = $aNews->fetch_assoc()){
                echo '
                <div class="post">
                <h2>'.$row["header"];
                echo "<div style='float: right;'><a href='?section=news&action=edit&id=".$row["id_wall"]."'><img src='img/icons/edit.png' class='icon' alt='Edycja' title='Edytować'></a>";
                echo "<a href='?section=news&action=delete&id=".$row["id_wall"]."'><img src='img/icons/delete.png' class='icon' alt='Usunąć' title='Usunąć'></a></div></h2>";

                echo '<p>'.$row["post_text"].'</p></div>
               ';
     }
        }
        break;

}