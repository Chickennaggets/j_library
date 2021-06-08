<?php


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

    function print_main_header(){
        echo '
        <title>Chór Katedralny im. Ks. Alfreda Hoffmana w Siedlcach</title>
        <link rel="stylesheet" href="../public/style.css">
        <script src="../public/script.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <div class="info_header">
            <div class="link">
                <a href="?section=info&action=mainpage" class="info_a">Strona główna</a>
            </div>
            <div class="link">
                <div class="dropdown">
                    <a href="?section=info" class="info_a">O chórze</a>
                      <div class="dropdown-content">
                        <a href="?section=info&action=szulik">Dyrygent</a>
                        <a href="?section=info&action=hoffman">Ks. A. Hoffman</a>
                        <a href="?section=info&action=history">Historia chóru</a>
                      </div>
                </div>          
            </div>
            
            <div class="link">
                <a href="" class="info_a">Aktualności</a>
            </div>
            
            <div class="link">
                <a href="?section=authorization" class="info_a">Biblioteka</a>
            </div>
            
            <div class="link">
                <a href="?section=info&action=kontakt" class="info_a">Kontakt</a>
            </div>
        </div>
                
        
        
        ';
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
                      <a href='?section=users' class = 'a'>Użytkowniki</a><br>
                      <a href='?section=news' class = 'a'>Aktualności</a><br>";
                echo "<hr>";
            }
            echo '<a href="?section=main" class = "a">Utwory</a><br>';

            echo '<a href="?section=users&action=logout" class = "a" onclick=log_out()>Wyloguj</a><br>';
        }
        else{
            echo '<a href="?section=authorization" class = "a">Zaloguj</a>';
        }
        echo '</div>';
    }

    function showError($text){
        echo $text;
    }

    function faceControle($section){
        global $oUser;
        $action = get::Get('action','',Get::TYPE_STR);
        $allowedForUsers = array('main', 'songs','users');
        if($oUser->isLogin() && !$oUser->isAdmin()){
            $decision = in_array($section, $allowedForUsers, true);
            if($section=='users' && $action != 'logout')
                $decision = false;
            return $decision;
        }
        else if(!$oUser->isLogin()){
            if($section == 'authorization'){
                return true;
            }
        }
        else if($oUser->isLogin() && $oUser->isAdmin()){
            return true;
        }
        else{
            return false;
        }

    }

    function print_footer()
    {
        echo '
        <footer class="footer">
            <p>
                Chór Katedralny im. Ks. Alfreda Hoffmana w Siedlcach © 2021 | website by Yan Ramanouski
            </p>
        </footer>
        ';
    }
    function print_up_button(){
        echo
        '<a id="upbutton" href="#" onclick="smoothJumpUp(); return false;">
            <img src="img/up.png" alt="Top" border="none" title="Do góry">
         </a>';
    }

    function getNameFolder($id){
    $min = 0;
    $max = 100;
        while(true){
            if($min < $id && $id < $max){
                if($min==0)
                    $result = "0".$min."00";
                else
                    $result = "0" . $min;
                return $result;
            }
            else{
                $min+=100;
                $max+=100;
            }
        }
    }

