<?php


    function print_header(){
        global $oUser;

        echo '      
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="script.js"></script>
            <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="style1.css">
            <title>Biblioteka Chóru</title>
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Biblioteka Chóru Katedralnego</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">                
                    ';
        if($oUser->isLogin()){
        echo '
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">'.$_SESSION["online_login"].'</a>
                        </li>';

        if($oUser->isGuest()){
            $count = $oUser->getCountDownloads($_SESSION["online_login"]);
            echo '
            <li>
                <a class="nav-link" href="#">Pobrania <span class="badge bg-secondary">'.$count.'</span></a>      
            </li>
            ';
        }

        echo'           <li class="nav-item">
                            <a class="nav-link" href="?section=main">Utwory</a>
                        </li>';
                        if($oUser->isAdmin()) {

                            echo '<li class="nav-item">
                                     <a class="nav-link" href="?section=folders">Teczki</a>
                                  </li>
                                  <li class="nav-item">
                                     <a class="nav-link" href="?section=users">Użytkowniki</a>
                                  </li>

                                   <li class="nav-item">
                                     <a class="nav-link" href="?section=news">Aktualności</a>
                                   </li>';
                            $num = $oUser->countQueries();
                            if($num==0){
                                $num="";
                            }
                            echo '
                                   <li>
                                      <a class="nav-link" href="?section=queries">Wnioski <span class="badge bg-secondary">'.$num.'</span></a>      
                                   </li>
                            ';

                        }
                        echo ' 
                        <li class="nav-item">
                            <a class="nav-link" href="?section=users&action=logout">Wyloguj</a>
                        </li>
                    ';
        }
                        echo '<li class="nav-item">
                                <a class="nav-link" href="?section=info&action=mainpage">Strona Chóru</a>
                              </li>
                           </ul></div></nav>';
    }

    function print_main_header(){
    echo '        
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="script.js"></script>
            <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
             <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
             <link rel="stylesheet" href="style1.css">
            
             <title>Chór Katedralny im. Ks. Alfreda Hoffmana w Siedlcach</title>    
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Chór Katedralny im. Ks. Alfreda Hoffmana w Siedlcach</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="?section=info&action=mainpage">Strona główna</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Aktualności</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?section=authorization">Biblioteka</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="?section=info" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    O chórze
                </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="?section=info&action=szulik">Dyrygent</a></li>
                    <li><a class="dropdown-item" href="#">II Dyrygent</a></li>
                    <li><a class="dropdown-item" href="#">Zarząd Chóru</a></li>
                    <li><a class="dropdown-item" href="?section=info&action=hoffman">Ks. A. Hoffman</a></li>
                    <li><a class="dropdown-item" href="?section=info&action=history">Historia chóru</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?section=info&action=kontakt">Kontakt</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>';
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
        
            <footer class="footer bg-dark">
                <p>
                    Chór Katedralny im. Ks. Alfreda Hoffmana w Siedlcach © 2021 | website by Yan Ramanouski 
                </p>
            </footer>
        
        ';
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

