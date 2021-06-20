<?php

global $conn;
global $oUser;

$action = Get::get('action', '', GET::TYPE_STR);

$oNews = new News();

switch($action) {
    case 'new_post':
        ?>
    <div class="container-fluid pt-5 w-25" style="min-height: 100vh; margin: auto;">
        <form action="?section=news&action=insert" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <h2 style="text-align: center">Aktualności - nowy zapis</h2>
            </div>
            <div class="mb-3">
                <label for="header" class="form-label">Zagłówek</label>
                <input type="text" class="form-control" required name = "header">
            </div>
            <div class="container mb-3">
                 <label for="formFile" class="form-label">Wgraj plik</label>
                 <input class="form-control" type="file" aria-label="browser" name="filename" id="formFile">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Tekst</span>
                <textarea class="form-control" required name="post_text" style="min-height: 200px" aria-label="Notatki"></textarea>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" class="btn btn-dark w-25" value="Zapisz">
            </div>
        </form>
    </div>

    <?php
        break;
    case 'insert':
        $header = Get::post('header', '', GET::TYPE_STR);
        $post_text = Get::post('post_text', '', GET::TYPE_STR);
        $picture = $_FILES['filename']['name'];

        if(move_uploaded_file($_FILES['filename']['tmp_name'], ROOT_FOLDER.'public/img/news/'.$_FILES['filename']['name'])){
        echo 'File was uploaded';
        }
        else{
            echo 'File is not uploaded';
        }
        $oNews->addPost($header,$post_text, $picture);

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
                    <input type="submit" class="btn btn-dark" value="Zapisz">
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
        $path = Get::get('pic', '', GET::TYPE_STR);
        unlink('img/news/'.$path);
        $oNews->deletePost($id);
        break;
    default:
        echo '<div class="container-fluid w-75 gx-1 p-3" style="min-height: 100vh">';
        echo '<div class="container-fluid mb-3"><a href="?section=news&action=new_post" class="btn btn-dark">Nowy zapis</a></div>';
        $aNews = $oNews->getAll();

        echo '<div class="container-fluid d-flex justify-content-start flex-wrap align-content-start align-items-start">';

        if($aNews->num_rows > 0){
            while($row = $aNews->fetch_assoc()){
                echo '
                <div class="card m-5" style="max-width: 450px; min-width: 300px">
                    <img src="img/news/'.$row["pictures"].'" class="card-img-top" alt="...">
                    <div class="card-body">
                            <h5 class="card-title">'.$row["header"].'</h5>
                            <p class="card-text">'.$row["post_text"].'</p>
                            <a href="#" class="btn btn-dark">Go somewhere</a>
                                <div class="float-end">
                                    <button class="btn" onclick=document.location="?section=news&action=edit&id='.$row["id_wall"].'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </button>
                            
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                             <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Napewno chcesz usunąć ten zapis ?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary w-25" onclick=document.location="?section=news&action=delete&id='.$row["id_wall"].'&pic='.$row["pictures"].'">Tak</button>
                                        <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Nie</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                ';
            }
        }
        echo '</div></div</div>';
        break;
}