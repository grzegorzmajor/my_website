<main class="main_login">
    <form action="/?action=login" method="post" class="form_login"> 
        <label class="form_login_label">
            MUSISZ SIĘ ZALOGOWAĆ!<?php $error=$_GET['error'] ?? 0; if($error==1) echo "<br>WPISZ POPRAWNE LOGIN I HASŁO!"; ?>
        </label><br>
        <label class="form_login_label">LOGIN: <input class="form_login_input" type="text" name="login"></label><br>
        <label class="form_login_label">HASŁO: <input class="form_login_input" type="password" name="password"></label><br>
        <button  class="form_login_button" type="submit">ZALOGUJ</button>
    </form>
</main>