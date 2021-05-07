<!doctype html>
<html>
<?php
    print_header();
?>
<body>
    <div style="width: 100%; text-align: center;">
<div class="reg_form">
    <form method="post" action="?action=authorization_sql" class = "form" id="fform">
          <h1 style="text-align: center; margin: 30px; background-color: transparent;">Zaloguj się</h1>
	
	<input type="text" class="edbx" name="log" id="log" required placeholder="Login*" data-validate><br><br>
    <span class="help-text"></span>
	<input type="password" class="edbx" name="has" id="has" required placeholder="Hasło*" onchange="checkpasswords()" data-validate><br><br>
  
<input type="submit" class="btn" value="Zaloguj"><br><br>
        <a class = "a" href="?action=registration">Zarejestruj</a>
    </form>
    </div>
        </div>
    </body>
</html>