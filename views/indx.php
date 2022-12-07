<main class="article-list">
        <h1>O MNIE</h1>
        <section class="aboutMeLeft">
            <img class="aboutMe" src=".\images\foto2.png" alt="">
<?php
                $omnie = $dataList['aboutMeLeft'] ?? null;
                if ($omnie) { echo $omnie; }
?>                   
        </section>
        <section class="aboutMeRight">
<?php
                $omnie = $dataList['aboutMeRight'] ?? null;
                if ($omnie) { echo $omnie; }
?>                   
        </section>                   
</main>