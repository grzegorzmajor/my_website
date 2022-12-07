<main class="main_new_prtf">
    <form class="form_new_prtf" action="/?action=addPrtf" method="post" enctype="multipart/form-data">        
        <h2>Dodaj kolejny element do portfolio!</h2>
        <label class="form_new_prtf_label">Tytuł<input class="form_new_prtf_input" type="text" name="title"></label>        
        <label class="form_new_prtf_label">Opis<textarea class="form_new_prtf_text" name="description"></textarea></label>
        <label class="form_new_prtf_label">Link do projektu<input class="form_new_prtf_input" type="text" name="link"></label>
        <label class="form_new_prtf_label">Obrazek<input accept="image/*" class="form_new_prtf_input_file" type="file" name="file"></label>
        <button class="form_new_prtf_button" type="submit">DODAJ</button>
    </form>

    <form class="form_new_prtf" action="/?action=addAboutMe" method="post" enctype="multipart/form-data">        
        <h2>Dodaj kolejny element do "O Mnie"!</h2>
        <label class="form_new_prtf_label">Tytuł<input class="form_new_prtf_input" type="text" name="title"></label>        
        <label class="form_new_prtf_label">Treść<textarea class="form_new_prtf_text" name="description"></textarea></label>
        
        <label class="form_new_prtf_label">Strona: 
            <label class="">Lewa<input type="radio" name="poz" value="0"></label>
            <label class="">Prawa<input type="radio" name="poz" value="1"></label></label>
        <button class="form_new_prtf_button" type="submit">DODAJ</button>
    </form>
</main>