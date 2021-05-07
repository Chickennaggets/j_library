<html>
<?php
    print_header();
?>
<body>
    <table>
        <tr>             <td style="width: 180px;" valign="top">
                <?php
                print_nav_menu();
                ?>
            </td>
             <td valign="top">
             <div class="p_navigator">    
                 

<select name="filters" class="edbx" id="filters" onclick="f()" style="margin-right: 30px;" >
  <option hidden value="1">Filtruj wg</option>
  <option value="1">Loginu</option>
  <option value="2">Daty rejestracji</option>
    <option value="3">Aktywacji</option>
    <option value="4">Uprawnień</option>
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
                xhttp.open("GET", "users_zap1.php", true);
                xhttp.send();
            }
            else if(document.getElementById("filters").value == 2){
                xhttp.open("GET", "users_zap2.php", true);
                xhttp.send();
            }
                        else if(document.getElementById("filters").value == 3){
                xhttp.open("GET", "users_zap3.php", true);
                xhttp.send();
            }
                        else if(document.getElementById("filters").value == 4){
                xhttp.open("GET", "users_zap4.php", true);
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
                xhttp.open("GET", "users_zap5.php?temp="+temp, true);
                xhttp.send();
        }
        
    
    </script>
    </body>
</html>