<?php


    function print_header(){
        echo '<head>
                    <title>Biblioteka Chóru Katedralnego</title>
                        <link rel="stylesheet" href="../public/style.css">
                        <script src="../public/script.js"></script>
                        <link rel="preconnect" href="https://fonts.gstatic.com">
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
                            <div class="header">
                                <a href="?section=info"><h1 class="zagl">Biblioteka Chóru Katedralnego</h1></a> 
                            </div>
               </head>';
    }

    function print_nav_menu()
    {
        global $oUser;
        echo '<div class="navigator">';
        if($oUser->isLogin()){
            echo $_SESSION["online_login"]."<br>";
            if($_SESSION["root"]){
                echo "(Administrator)<br><br>";
            }else{
                echo "(Użytkownik)<br><br>";
            }
            if($oUser->isAdmin()){
                echo "<a href='?section=folders' class = 'a'>Teczki</a><br>
                           <a href='?section=users' class = 'a'>Użytkowniki</a><br>";
                echo "<hr>";
            }
            echo '<a href="?section=main" class = "a">Utwory</a><br>';
            echo '<a href="?section=info" class = "a">O chórze</a><br>';
            echo '<a href="?section=users&action=logout" class = "a">Wyloguj</a><br>';
        }
        else{
            echo '<a href="?section=info" class = "a">O chórze</a><br>';
            echo '<a href="?section=authorization" class = "a">Zaloguj</a>';
        }
                echo '</div>';
    }

    function showError($text){
        echo $text;
    }

    function faceControle($section){

        global $oUser;

        $allowedForAll = array('authorization','info','error');
        $allowedForUsers = array('authorization','info','error','main', 'songs');

        if(!$oUser->isLogin()){
            foreach ($allowedForAll as $value){
                if(strcasecmp($section, $value)){
                    return true;
                }
            }
            return false;
        }

        else if($oUser->isLogin() && !$oUser->isAdmin()){
            foreach ($allowedForUsers as $value){
                if(strcasecmp($section, $value)){
                    return true;
                }
            }
            return false;
        }

        else if($oUser->isLogin() && $oUser->isAdmin()){
            return true;
        }
    }



