<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oNews = new News();

switch($action) {
    case 'new_post':
        ?>
    <div class="container-fluid pt-5 w-25" style="min-height: 100vh; margin: auto;">
        <form action="?section=news&action=insert" method="post">
            <div class="mb-3">
                <h2 style="text-align: center">Aktualności - nowy zapis</h2>
            </div>
            <div class="mb-3">
                <label for="header" class="form-label">Zagłówek</label>
                <input type="text" class="form-control" required name = "header">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Tekst</span>
                <textarea class="form-control" required name="post_text" style="min-height: 200px" aria-label="Notatki"></textarea>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" class="btn btn-primary w-25" value="Zapisz">
            </div>
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
        <div class="container-fluid pt-5 w-25" style="min-height: 100vh; margin: auto;">
            <form action="?section=news&action=update" method="post">
                <div class="mb-3">
                    <h2>Aktualności - Edycja</h2>
                </div>
                <div class="mb-3">
                    <input type="text" hidden name="id" value="<?php echo $id; ?>">
                    <label for="header" class="form-label">Zagłówek</label>
                    <input type="text" class="form-control" placeholder="Zagłówek" required name = "header" value="<?php echo $aNews["header"]; ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Tekst</span>
                    <textarea class="form-control" required name="post_text" aria-label="Notatki" style="min-height: 200px"><?php echo $aNews["post_text"]; ?></textarea>
                </div>
                <div class="mb-3 text-center">
                    <input type="submit" class="btn btn-primary" value="Zapisz">
                </div>
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
        echo '<div class="container-fluid w-75 gx-5 p-3" style="min-height: 100vh">';
        echo '<div class="container-fluid mb-3"><a href="?section=news&action=new_post">Nowy zapis</a></div>';
        $aNews = $oNews->getAll();

        if($aNews->num_rows > 0){
            while($row = $aNews->fetch_assoc()){
                echo '
                <div class="container-fluid w-100 gx-5 mb-3 " >
                    <div class="card">
                        <h5 class="card-header bg-dark" style="color: white">'.$row["header"].'</h5>
                        <div class="card-body bg-light">
                            <h5 class="card-title"></h5>
                            <p class="card-text ">'.$row["post_text"].'</p>
                            <a href="?section=news&action=edit&id='.$row["id_wall"].'">Edycja</a>
                        </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Usunąć
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Napewno chcesz usunąć ten zapis ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary w-25" onclick=document.location="?section=news&action=delete&id='.$row["id_wall"].'">Tak</button>
                            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Nie</button>
                        </div>
                    </div>
                </div>
            </div>
        
                    </div>
                </div>';
            }
        }
        echo '</div>';
        break;
}