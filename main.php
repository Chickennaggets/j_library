<html>
<?php
    session_start();
    print_header();
?>

<body>
    <table>
         <tr>
                 <?php
                    print_nav_menu();
                 ?>

             <td valign="top">
             <div class="p_navigator">

<<select name="filters" class="edbx" id="filters" onclick="f()" style="margin-right: 30px;" >
  <option hidden value="1">Filtruj wg</option>
  <option value="1">Numeru teczki</option>
  <option value="2">Autora</option>
  <option value="3">Nazwy utworu</option>
  <option value="4">Ilości partytur</option>
  <option value="5">Nazwy teczki</option>
</select>>
     <input type = "text" id="sz_text" class="edbx" placeholder="Szukaj*" onchange="sz()">   
                 <input type="button" value="Szukaj" class="btn" id="sz_btn" onclick="sz()" style="margin-left: 10px;">
                 
                 <br><br>
                 <div id = "demo">



                 </div>  </div> </td>
    </table>
    <script>
        f();
        function f(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("demo").innerHTML = this.responseText;
                }
                };
            if(document.getElementById("filters").value == 1){
                xhttp.open("GET", "?action=zap1", true);
                xhttp.send();
            }
            else if(document.getElementById("filters").value == 2){
                xhttp.open("GET", "?action=zap2", true);
                xhttp.send();
            }
            else if(document.getElementById("filters").value == 3){
                xhttp.open("GET", "?action=zap3", true);
                xhttp.send();
            }
             else if(document.getElementById("filters").value == 4){
                xhttp.open("GET", "?action=zap4", true);
                xhttp.send();
            }
            else if(document.getElementById("filters").value == 5){
                xhttp.open("GET", "?action=zap5", true);
                xhttp.send();
            }
            }
        function sz(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("demo").innerHTML = this.responseText;
                }
                };
            temp = document.getElementById("sz_text").value;
                xhttp.open("GET", "?action=zap6&temp="+temp, true);
                xhttp.send();
        }
    </script>
    </body>
</html>