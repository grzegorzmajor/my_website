<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" type="image/png" href="\images\favicon.png" sizes="16x16" />
    <title>Major Grzegorz</title>
    <link rel="stylesheet" href=".\style\style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
<?php
        if($this->action=="indx") echo '<link rel="stylesheet" href=".\style\omnie.css">';
        if($this->action=="prtf") echo '<link rel="stylesheet" href=".\style\prtf.css">';    
        if($this->action=="linki") echo '<link rel="stylesheet" href=".\style\cv.css">';  
        if($this->action=="login" || $this->action=="editPrtf" ) echo '<link rel="stylesheet" href=".\style\login.css"><link rel="stylesheet" href=".\style\adm.css">';
        if($this->action=="uc") echo '<link rel="stylesheet" href=".\style\uc.css">';
?>
</head>

<body>
    <header>
        <div class="header-img">
            <img src=".\images\banner.jpg" alt="">
            <p>STRONA W BUDOWIE</p>
        </div>
        <nav class="nav">
            <ul>
<?php
                    if($this->action!="indx") echo '<li><a class="link" href="/">O Mnie</a></li>';
                    if($this->action!="prtf") echo '<li><a class="link" href="/?action=prtf">Portfolio</a></li>';
                    if($this->action!="linki") echo '<li><a class="link" href="/?action=linki">Po godzinach</a></li>';
                    if($this->action!="login") echo '<li><a class="link" href="/?action=login">Panel</a></li>';
?>
            </ul>
        </nav>
    </header>
<?php
        require_once APP_DIR .'/../views/'.$tmplt.'.php';
?>
    <footer>
        <a href="http://www.major.ovh">&copy 2022 Grzegorz Major</a>
    </footer>
    
</body>
</html>