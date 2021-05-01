<?php
session_start();

?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <div class="header">
        <h1 class="zagl">Biblioteka Chóru Katedralnego</h1>
        <title>Biblioteka Chóru Katedralnego</title>
    </div>
    
</head>
<body>
    <table>
         <tr><td style="width: 180px;" valign="top">
             <div class="navigator">
             <?php 
                 echo $_SESSION["online_login"]."<br>";
                 if($_SESSION["root"]){
                     echo "(Administrator)<br><br>";
                 }else{
                     echo "(Użytkownik)<br><br>";
                 }?>
             <a href="?action=main" class = "a">Główna</a><br>
                 <?php if($_SESSION["root"]) { ?>
                     <a href='?action=add_song' class = 'a'>Nowy utwór</a><br>
                     <a href='?action=folders' class = 'a'>Teczki</a><br>
                     <a href='?action=users' class = 'a'>Użytkowniki</a><br>
                 <?php } ?>
              <a href="action=authorization" class = "a">Wyloguj</a><br>
             </div>
             </td>
             <td valign="top">
             <div class="p_navigator">    
                 

<select name="filters" class="edbx" id="filters" onclick="f()" style="margin-right: 30px;" >
  <option hidden value="1">Filtruj wg</option>
  <option value="1">Numeru teczki</option>
  <option value="2">Autora</option>
  <option value="3">Nazwy utworu</option>
  <option value="4">Ilości partytur</option>
  <option value="5">Nazwy teczki</option>
</select>
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
                xhttp.open("GET", "zap2.php", true);
                xhttp.send();
            }
            else if(document.getElementById("filters").value == 3){
                xhttp.open("GET", "zap3.php", true);
                xhttp.send();
            }
             else if(document.getElementById("filters").value == 4){
                xhttp.open("GET", "zap4.php", true);
                xhttp.send();
            }
            else if(document.getElementById("filters").value == 5){
                xhttp.open("GET", "zap5.php", true);
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
                xhttp.open("GET", "zap6.php?temp="+temp, true);
                xhttp.send();
        }
        
    
    </script>
    </body>
</html>