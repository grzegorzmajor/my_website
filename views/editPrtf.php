<main class="main_new_prtf">
    <form class="form_new_prtf" action="/?action=updatePrtf<?php $id=$_GET['id']; echo "&id=$id"; ?>" method="post" enctype="multipart/form-data">        
        <h2>Edytuj element portfolio.</h2>
        <label class="form_new_prtf_label">Tytuł<input class="form_new_prtf_input" type="text" name="title" value="<?php
            $data = $dataList['title'] ?? null;
            if ($data) { echo $data; }
        ?>"></label>       
        <label class="form_new_prtf_label">Opis<textarea class="form_new_prtf_text" name="description"><?php 
            $data = $dataList['descr'] ?? null;
            if ($data) { echo $data; }
        ?></textarea></label>
        <label class="form_new_prtf_label">Link do projektu<input class="form_new_prtf_input" type="text" name="link" value="<?php
            $data = $dataList['projPath'] ?? null;
            if ($data) { echo $data; }
        ?>"></label>
        <button class="form_new_prtf_button" type="submit">ZAPISZ</button>
    </form>
    <form class="form_new_prtf" action="/?action=updateFotoPrtf<?php $id=$_GET['id']; echo "&id=$id"; ?>" method="post" enctype="multipart/form-data">        
        <h2>Zmień zdięcie.</h2>
        <label class="form_new_prtf_label">Obrazek<input accept="image/*" class="form_new_prtf_input_file" type="file" name="file"></label>
        <button class="form_new_prtf_button" type="submit">ZAPISZ</button>
    </form>

</main>