<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <div class="header">
        <h1 class="zagl">Biblioteka Chóru Katedralnego</h1>
    </div>
    
</head>
<body>
    <table>
         <tr><td style="width: 180px;" valign="top">
             <div class="navigator">
                   <?php 
                 session_start();
                 echo $_SESSION["online_login"]."<br>";
                 if($_SESSION["root"]){
                     echo "(Administrator)<br><br>";
                 }else{
                     echo "(Użytkownik)<br><br>";
                 }?>
             <a href="main.php" class = "a">Główna</a><br>
                 <?php
                 if($_SESSION["root"]){
                     echo "<a href='add_song.php' class = 'a'>Nowy utwór</a><br>";
                     echo "<a href='folders.php' class = 'a'>Teczki</a><br>";
                     echo "<a href='users.php' class = 'a'>Użytkowniki</a><br>";
                 }                
                 ?>
              <a href="authorization.html" class = "a">Wyloguj</a><br>
             </div>
             </td>
            <td valign="top" style="width: 80%;">
                 <div class="p_navigator" style="width: 100%;">
         <form method="post" action="add_fold_sql.php" class = "form">
          <h1 style="text-align: center; margin: 30px; background-color: transparent;">Nowa teczka</h1>
	
	<input type="text" class="edbx" name="name_fold" id="name_fold" required placeholder="Nazwa teczki*" data-validate><br><br> <textarea name = "note" id = "note" placeholder="Notatki"></textarea><br><br>   
             
	<input type="submit" name="submit"  class="btn" value="Dodaj">
       
</form>    
                     </div>
       
             </td>
    </table>
    </body>
</html>