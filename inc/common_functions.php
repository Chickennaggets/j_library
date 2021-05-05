<?php
    function print_header(){
        echo '<head>
    <title>Biblioteka Chóru Katedralnego</title>
    <link rel="stylesheet" href="../public/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <div class="header">
        <h1 class="zagl">Biblioteka Chóru Katedralnego</h1>   
    </div>
</head>';
}
    function print_nav_menu()
    {
        echo '<td style="width: 180px;" valign="top"><div class="navigator">';
                 echo $_SESSION["online_login"]."<br>";
                 if($_SESSION["root"]){
                     echo "(Administrator)<br><br>";
                 }else{
                     echo "(Użytkownik)<br><br>";
                 }
             echo '<a href="?action=main" class = "a">Główna</a><br>';
                 if($_SESSION["root"]) {
                     echo "<a href='?action=add_song' class = 'a'>Nowy utwór</a><br>
                     <a href='?action=folders' class = 'a'>Teczki</a><br>
                     <a href='?action=users' class = 'a'>Użytkowniki</a><br>";
                 }
                 echo '<a href="authorization.html" class = "a">Wyloguj</a><br></div></td>';
    }
