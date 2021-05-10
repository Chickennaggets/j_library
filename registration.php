<!doctype html>
<html>
<?php
    print_header();
?>
<body>
    <div style="width: 100%; text-align: center;">
        <div class="reg_form">
            <form method="post" action="?action=regist_zap" class = "form" id="fform">
                <h1 style="text-align: center; margin: 30px; background-color: transparent;">Rejestracja</h1>
	
	            <input type="text" class="edbx" name="log" id="log" required placeholder="Login*" data-validate><br><br>
                <span class="help-text"></span>

	            <input type="text" class="edbx" name="has1" id="has1" required placeholder="Hasło*" onchange="checkpasswords()" data-validate><br>
                <span class="log-text"></span><br>
        
                <input type="text" class="edbx" name="has2" id="has2" required placeholder="Powtóż hasło*" onchange="checkpasswords()" data-validate><br>
                <span class="help-text"></span><br>
  
                <input type="button" onclick="reg()" class="btn" value="Zarejestruj"><br><br>
                <a class = "a" href="?action=authorization">Zalogj</a>
            </form>
        </div>
    </div>
    </body>
</html>