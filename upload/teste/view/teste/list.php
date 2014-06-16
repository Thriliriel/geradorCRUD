<section id="lista">
    <h1>teste</h1>
    
    <!--MESSAGE-->
    <?php if($mensagem != ""){ ?>
    <p><?php echo $mensagem ?></p>
    <?php } ?>
    
    <!--INCLUDE AND SEARCH-->
    <div class="operacoes">
        <a href="<?php echo url::base() ?>teste/edit" class="btn-inserir">Insert</a>

        <form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>teste/pesquisa" class="pesquisa">
            <label for="chave">Type something:</label>
            <input type="search" id="chave" name="chave" placeholder="Busca" />
            <button type="submit">Search</button>
        </form>
    </div>
    
    <!--DATA LIST-->
    <table class="padrao">
        <colgroup>
            <col class="box">
            <col class="codigo direita">
            <col>
            <col class="acoes">
        </colgroup>
        <thead>
            <tr>
                <th><input type="checkbox" class="seleciona" onclick="selecionar(this.checked)" valor="0"></th>
                <th class="codigo direita">Código</th>
                <th>Titulo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //IF HAS DATA, SHOW IT. ELSE, SHOW THE WARNING
            if (count($teste) > 0) {
                foreach($teste as $tes){
                    ?>
                    <tr>
                        <td><input type="checkbox" class="seleciona" valor="<?php echo $tes["TES_ID"]; ?>"></td>
                        <td class="codigo direita"><?php echo $tes["TES_ID"]; ?></td>
                        <td><?php echo $tes["TES_TITULO"]; ?></td>
                        <td>
                            <a href="<?php echo url::base() ?>teste/edit/<?php echo $tes["TES_ID"]; ?>" 
                                class="btn-editar"></a>
                            <a onclick="
                                if (window.confirm('Do you really want to delete this data?')) {
                                    location.href = '<?php echo url::base() ?>teste/excluir/<?php echo 
                                        $tes["TES_ID"]; ?>';
                                }    
                               " class="btn-excluir">
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                ?>
                <tr>
                    <td colspan="4" class="naoEncontrado">No Teste found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    
    <!--DELETE ALL CHECKED-->
    <div class="operacoes">
        <a onclick="
            if (window.confirm('Do you really want to delete all checked data?')) {
                excluirTodos('<?php echo Request::current()->controller(); ?>');
            }
           " class="btn-excluir-todos">Delete all checked</a>
    </div>

    <!--PAGINATION-->
    <?php echo $pagination; ?>
</section>

<!--FORM TO DELETE ALL CHECKED-->
<div id="formExc"></div>
