<section id="formulario">
    <h1>teste</h1>
    <form action="<?php echo url::base() ?>teste/save" class="padrao" id="formEdit" name="formEdit" method="post">
	
        <!--IF NECESSARY, INFORMATIONS-->
        <!--<p></p>-->

        <input type="hidden" id="TES_ID" readonly name="TES_ID" value="<?php echo $teste["TES_ID"] ?>">
    
        <div class="item-form">
            <label for="TES_TITULO">Titulo</label>
            <input type="text" value="<?php if($teste) echo $teste["TES_TITULO"] ?>" id="TES_TITULO" name="TES_TITULO">
        </div>
                            
        <div class="item-form">
            <label for="TES_DATA">Data</label>
            <input type="text" class="data pequeno" value="<?php if($teste) echo Controller_Index::aaaammdd_ddmmaaaa($teste["TES_DATA"]) ?>" id="TES_DATA" name="TES_DATA">
        </div>
                                        
        <div class="final">
            <button type="submit" id="salvar">Send</button>
            <button type="reset" id="limpa">Clear</button>
            <p class="legenda"><em>*</em> Required Fields.</p>
        </div>
    </form>
</section>