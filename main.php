<?php
global $oUser;
?>

<div class="container gx-5" >
    <div class="row pb-4">
        <div class="col">
            <?php
            if($oUser->isAdmin()){
                echo '<a href="?section=songs&action=add" class = "btn btn-outline-dark px-3">
                        Nowy utwór</a>';
            }
            ?>
        </div>
        <div class="col">
            <?php
            echo '<select name="filters" class="form-select" onchange="m_srch()" id="filters">';
            echo        '<option hidden value="name_song">Sortuj wg</option>';
            if(!$oUser->isGuest()){ echo '<option value="id_song">Numeru teczki</option>'; }
            echo       ' <option value="author">Autora</option>';
            echo         '<option value="name_song">Nazwy utworu</option>';
            if(!$oUser->isGuest()){ echo '<option value="count">Ilości partytur</option>
                    <option value="name_folder">Nazwy teczki</option>'; }
              echo '</select>';
            ?>
        </div>
        <div class="col">
            <input type = "text" id="sz_text" class="form-control" placeholder="Szukaj*" onchange="m_srch()">
        </div>
        <div class="col">
            <button class="btn btn-dark px-3" id="sz_btn" onclick="m_srch()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                Szukaj
            </button>
        </div>
        </div>
    </div>
</div>
    <div id = "demo">
    </div>
    <script>
        m_srch();
    </script>
<?php