<main class="main_new_prtf">
    <form class="form_new_prtf" action="/?action=updateAboutMe<?php $id=$_GET['id']; echo "&id=$id"; ?>" method="post" >        
        <h2>Dodaj kolejny element do "O Mnie"!</h2>
        <label class="form_new_prtf_label">Tytuł<input class="form_new_prtf_input" type="text" name="title" value="<?php
            $data = $dataList['title'] ?? null;
            if ($data) { echo $data; }
        ?>"></label>
        <label class="form_new_prtf_label">Treść<textarea class="form_new_prtf_text" name="description"><?php 
            $data = $dataList['descr'] ?? null;
            if ($data) { echo $data; }
        ?></textarea></label>        
            
        <label class="form_new_prtf_label">Strona: 
            <label class="">Lewa<input type="radio" name="poz" value="0" <?php
            $data = $dataList['poz'] ?? null;
            if ($data==0) { echo "checked"; }
        ?>></label>
            <label class="">Prawa<input type="radio" name="poz" value="1" <?php
            $data = $dataList['poz'] ?? null;
            if ($data==1) { echo "checked"; }
        ?>></label></label>
        <button class="form_new_prtf_button" type="submit">DODAJ</button>
    </form>
</main>
