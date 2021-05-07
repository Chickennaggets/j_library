<html>
<?php
    print_header();
?>
<body>
    <table>
         <tr>
             <td style="width: 180px;" valign="top">
                 <?php
                    print_nav_menu();
                 ?>
             </td>
             <td valign="top">
             <div class="p_navigator">

<select name="filters" class="edbx" id="filters" style="margin-right: 30px;" >
    <option hidden value="id_song">Filtruj wg</option>
    <option value="id_song">Numeru teczki</option>
    <option value="author">Autora</option>
    <option value="name_song">Nazwy utworu</option>
    <option value="count">Ilości partytur</option>
    <option value="name_folder">Nazwy teczki</option>
</select>
     <input type = "text" id="sz_text" class="edbx" placeholder="Szukaj*" onchange="sz()">   
                 <input type="button" value="Szukaj" class="btn" id="sz_btn" onclick="sz()" style="margin-left: 10px;">
                 <br><br>
                 <div id = "demo">
                 </div>  </div> </td>
    </table>
    <script>
        sz();
        function sz(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("demo").innerHTML = this.responseText;
                }
                };
            var word = document.getElementById("sz_text").value;
            var filt = document.getElementById("filters").value
                xhttp.open("GET", "?action=zap1&parameter="+filt+"&word="+word, true);
                xhttp.send();
        }
    </script>
    </body>
</html>