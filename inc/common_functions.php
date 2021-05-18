<?php
    global $oUser;

    function print_header(){
        echo '<head>
                    <title>Biblioteka Chóru Katedralnego</title>
                        <link rel="stylesheet" href="../public/style.css">
                        <script src="../public/script.js"></script>
                        <link rel="preconnect" href="https://fonts.gstatic.com">
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
                            <div class="header">
                                <h1 class="zagl">Biblioteka Chóru Katedralnego</h1>   
                            </div>
               </head>';
    }

    function print_nav_menu()
    {
        echo '<div class="navigator">';
                 echo $_SESSION["online_login"]."<br>";
                 if($_SESSION["root"]){
                     echo "(Administrator)<br><br>";
                 }else{
                     echo "(Użytkownik)<br><br>";
                 }
             echo '<a href="?section=main" class = "a">Utwory</a><br>';
                 if($_SESSION["root"]) {
                     echo "<a href='?section=folders' class = 'a'>Teczki</a><br>
                           <a href='?section=users' class = 'a'>Użytkowniki</a><br>";
                 }
                 echo '<a href="?section=info" class = "a">O chórze</a><br>';

                 echo '<a href="?section=users&action=logout" class = "a">Wyloguj</a><br>
                </div>';
    }




