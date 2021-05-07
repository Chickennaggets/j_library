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
                    <select name="filters" class="edbx" id="filters" onclick="f()" style="margin-right: 30px;" >
                          <option hidden value="login">Filtruj wg</option>
                          <option value="login">Loginu</option>
                          <option value="regist_date">Daty rejestracji</option>
                          <option value="activated">Aktywacji</option>
                          <option value="adminn">Uprawnień</option>
                    </select>
                    <input type = "text" id="sz_text" class="edbx" placeholder="Szukaj*" onchange="u_srch()">
                    <input type="button" value="Szukaj" class="btn" id="sz_btn" onclick="u_srch()" style="margin-left: 10px;"><br><br>
                     <div id = "demo">
                     </div>
                 </div>
             </td>
    </table>
    <script>
        u_srch();
    </script>
    </body>
</html>