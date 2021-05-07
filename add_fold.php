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
             <td valign="top" style="width: 80%;">
                 <div class="p_navigator" style="width: 100%;">
                    <form method="post" action="?action=add_fold_sql" class = "form">
                        <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowa teczka</h1>
                        <input type="text" class="edbx" name="name_fold" id="name_fold"
                                            required placeholder="Nazwa teczki*" data-validate><br><br>
                        <textarea name = "note" id = "note" placeholder="Notatki"></textarea><br><br>
                        <input type="submit" name="submit"  class="btn" value="Dodaj">
       
                    </form>
                 </div>
             </td>
    </table>
</body>
</html>