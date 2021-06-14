<?php

?>

<div class="container gx-5" >
    <div class="row pb-4">
        <div class="col">
            <?php
            if($_SESSION["root"]){
                echo "<a href='?section=songs&action=add' class = 'a nav icon newfile'>Nowy utwór</a>";
            }
            ?>
        </div>
        <div class="col">
            <select name="filters" class="form-select" onchange="m_srch()" id="filters">
                <option hidden value="id_song">Filtruj wg</option>
                <option value="id_song">Numeru teczki</option>
                <option value="author">Autora</option>
                <option value="name_song">Nazwy utworu</option>
                <option value="count">Ilości partytur</option>
                <option value="name_folder">Nazwy teczki</option>
            </select>
        </div>
        <div class="col">
            <input type = "text" id="sz_text" class="form-control" placeholder="Szukaj*" onchange="m_srch()">
        </div>
        <div class="col">
            <input type="button" value="Szukaj" class="btn btn-primary" id="sz_btn" onclick="m_srch()">
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