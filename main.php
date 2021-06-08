<?php

?>

<div class="top_panel">
    <?php
        if($_SESSION["root"]){
            echo "<a href = '?section=songs&action=add' class = 'a' ><div class='nav_part' style='font-size: 17px'><img src='img/icons/newfile.png' class='icon'><div class='n_text'>Nowy utwór</div></div></a>";
        }
    ?>
    <select name="filters" class="edbx" onchange="m_srch()" id="filters" >
        <option hidden value="id_song">Filtruj wg</option>
        <option value="id_song">Numeru teczki</option>
        <option value="author">Autora</option>
        <option value="name_song">Nazwy utworu</option>
        <option value="count">Ilości partytur</option>
        <option value="name_folder">Nazwy teczki</option>
    </select>
        <input type = "text" id="sz_text" class="edbx" placeholder="Szukaj*" onchange="m_srch()">
        <input type="button" value="Szukaj" class="btn" id="sz_btn" onclick="m_srch()">
</div>
    <div id = "demo">
    </div>
    <script>
        m_srch();
    </script>
<?php