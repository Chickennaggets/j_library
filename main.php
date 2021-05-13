<?php

?>
                     <script>
                         m_srch();
                     </script>
<div>
                     <?php
                     if($_SESSION["root"]){
                         echo "<a href = '?section=songs&action=add' class = 'a' style = 'margin-right: 30px'>Nowy utwór</a>";
                     }
                     ?>
                    <select name="filters" class="edbx" onchange="m_srch()" id="filters" style="margin-right: 30px;" >
                        <option hidden value="id_song">Filtruj wg</option>
                        <option value="id_song">Numeru teczki</option>
                        <option value="author">Autora</option>
                        <option value="name_song">Nazwy utworu</option>
                        <option value="count">Ilości partytur</option>
                        <option value="name_folder">Nazwy teczki</option>
                    </select>
                     <input type = "text" id="sz_text" class="edbx" placeholder="Szukaj*" onchange="m_srch()">
                     <input type="button" value="Szukaj" class="btn" id="sz_btn" onclick="m_srch()" style="margin-left: 10px;"><br><br>
</div>
                     <div id = "demo">
                     </div>

<?php