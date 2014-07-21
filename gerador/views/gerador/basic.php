<!--SCRIPTS - FIX THE PATHS-->
<!--JQUERY-->
<script src="<?php echo url::base() ?>extras/jquery-1.10.2.min.js" type="text/javascript"></script>

<!--FANCYBOX-->
<script src="<?php echo url::base() ?>extras/jquery.fancybox-1.3.1.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo url::base() ?>extras/jquery.fancybox-1.3.1.min.css" type="text/css" media="" />
<!--END SCRIPTS-->

<div id="interno">
    <h1>Generate CRUD</h1>

    <p><a href="#instrucoes" id="abreInstrucao" >Instructions</a></p>

    <p>To generate a new CRUD, fill below:</p>

    <form class="padrao" id="form_cadastro" name="form_cadastro" method="post">
        <fieldset>
            <legend>Module</legend>
            <div class="item-form hases">
                <label for="fTabela">Table</label>
                <input type="text" id="fTabela" name="fTabela" validar="texto" />

                <label for="fHas">Has</label>
                <input type="text" id="fHas" name="fHas[]" />

                <img src="<?php echo url::base(); ?>extras/bt_mais.png" class="mais" onclick="maisHas()" />
                <img src="<?php echo url::base(); ?>extras/bt_menos.png" class="menos" onclick="menosHas()" />
            </div>
        </fieldset>

        <fieldset>
            <legend>Fields</legend>
            <div class="item-form campos">
                <label for="fCampo">Field</label>
                <input type="text" id="fCampo" name="fCampo[]" value="ID" />
                <label for="fTipo">Type</label>
                <select id="fTipo" name="fTipo[]" onchange="setTamanho(this)">
                    <option value="VARCHAR">String</option>
                    <option value="PASSWORD">Password</option>
                    <option value="TEXT">Text</option>
                    <option value="INT" selected>Integer</option>
                    <option value="DECIMAL">Values (ex: 39,67)</option>
                    <option value="DATE">Date</option>
                    <option value="TIME">Hour</option>
                    <option value="TIMESTAMP">Date and Hour</option>
                    <option value="SET">Set (ex: Yes or No)</option>
                    <option value="IMAGEM">Image</option>
                    <option value="ARQUIVO">File (ex: DOC or PDF)</option>
                </select>
                <label for="fTamanho">Size</label>
                <input type="text" class="pno" id="fTamanho" name="fTamanho[]" value="11" />
                <label for="fDefault">Default</label>
                <input type="text" id="fDefault" name="fDefault[]" value="" />
                <label for="fPrimaria">Primary</label>
                <select id="fPrimaria" name="fPrimaria[]" style='width: 60px;' >
                    <option value="S" selected>Yes</option>
                    <option value="N">No</option>
                </select>
                <label for="fAuto">Auto</label>
                <select id="fAuto" name="fAuto[]" style='width: 60px;' >
                    <option value="S" selected>Yes</option>
                    <option value="N">No</option>
                </select>
                <label for="fRef">Ref</label>
                <input type="text" id="fRef" name="fRef[]" value="" />
                <label for="fPesquisar">Search</label>
                <select id="fPesquisar" name="fPesquisar[]" style='width: 60px;' >
                    <option value="S">Yes</option>
                    <option value="N" selected>No</option>
                </select>
                <label for="fReq">Required</label>
                <select id="fReq" name="fReq[]" style='width: 60px;' >
                    <option value="S" selected>Yes</option>
                    <option value="N">No</option>
                </select>

                <img src="<?php echo url::base(); ?>extras/bt_mais.png" class="mais" onclick="maisCampo()" />
                <img src="<?php echo url::base(); ?>extras/bt_menos.png" class="menos" onclick="menosCampo()" />
            </div>
        </fieldset>

        <button type="submit" id="cadastrar">Send</button>
        <button type="reset" id="limpar">Clear</button>
    </form>
    <div id="envies" style="color: red; display: none;">Wait...</div>
</div>

<script type="text/javascript">
    //FIELDS COUNT
    var total = 1;
    var totalHas = 1;

    //NEW FIELD
    var campo = '<div class="item-form campos" >' +
            '<label for="fCampo">Field</label>' +
            '<input type="text" id="fCampo" name="fCampo[]" value="" />' +
            '<label for="fTipo">Type</label>' +
            '<select id="fTipo" name="fTipo[]" onchange="setTamanho(this)">' +
            '<option value="VARCHAR" selected>String</option>' +
            '<option value="PASSWORD">Password</option>' +
            '<option value="TEXT">Text</option>' +
            '<option value="INT">Integer</option>' +
            '<option value="DECIMAL">Values (ex: 39,67)</option>' +
            '<option value="DATE">Date</option>' +
            '<option value="TIME">Hour</option>' +
            '<option value="TIMESTAMP">Date e Hour</option>' +
            '<option value="SET">Set (ex: Yes or No)</option>' +
            '<option value="IMAGEM">Image</option>' +
            '<option value="ARQUIVO">File (ex: DOC or PDF)</option>' +
            '</select>' +
            '<label for="fTamanho">Size</label>' +
            '<input type="text" class="pno" id="fTamanho" name="fTamanho[]" value="" />' +
            '<label for="fDefault">Default</label>' +
            '<input type="text" id="fDefault" name="fDefault[]" value="" />' +
            '<label for="fPrimaria">Primary</label>' +
            '<select id="fPrimaria" name="fPrimaria[]" style="width: 60px;" >' +
            '<option value="S">Yes</option>' +
            '<option value="N" selected>No</option>' +
            '</select>' +
            '<label for="fAuto">Auto</label>' +
            '<select id="fAuto" name="fAuto[]" style="width: 60px;" >' +
            '<option value="S">Yes</option>' +
            '<option value="N" selected>No</option>' +
            '</select>' +
            '<label for="fRef">Ref</label>' +
            '<input type="text" id="fRef" name="fRef[]" value="" />' +
            '<label for="fPesquisar">Search</label>' +
            '<select id="fPesquisar" name="fPesquisar[]" style="width: 60px;" >' +
            '<option value="S">Yes</option>' +
            '<option value="N" selected>No</option>' +
            '</select>' +
            '<label for="fReq">Required</label>' +
            '<select id="fReq" name="fReq[]" style="width: 60px;" >' +
            '<option value="S" selected>Yes</option>' +
            '<option value="N">No</option>' +
            '</select>' +
            '</div>';

    //NEW HAS
    var Has = '<div class="item-form hases">' +
            '<span>&nbsp;</span>' +
            '<span>&nbsp;</span>' +
            '<label for="fHas">Has</label>' +
            '<input type="text" id="fHas" name="fHas[]" />' +
            '</div>';

    function maisCampo() {
        $(".campos").last().after(campo);
        total++;
    }

    function menosCampo() {
        if (total > 1) {
            $(".campos").last().remove();
            total--;
        }
    }

    function maisHas() {
        $(".hases").last().after(Has);
        totalHas++;
    }

    function menosHas() {
        if (totalHas > 1) {
            $(".hases").last().remove();
            totalHas--;
        }
    }

    function setTamanho(put) {
        var list = put.parentNode;
        if (list.children) {
            var child = list.children[5];

            //SETS THE DEFAULT VALUE AS EMPTY
            list.children[7].value = "";

            //SETS THE PRIMARY VALUE AS "NO"
            list.children[9].value = "N";

            //SETS THE AUTO INCREMENT VALUE AS "NO"
            list.children[11].value = "N";

            switch (put.value) {
                case "VARCHAR":
                    child.value = 100;
                    break;
                case "PASSWORD":
                    child.value = 32;
                    break;
                case "INT":
                    child.value = 11;
                    //SETS THE DEFAULT VALUE AS 0
                    list.children[7].value = 0;
                    break;
                case "DECIMAL":
                    child.value = "10,2";
                    //SETS THE DEFAULT VALUE AS 0
                    list.children[7].value = 0;
                    break;
                case "DATE":
                    //SETS THE DEFAULT VALUE AS EMPTY
                    list.children[7].value = '';
                    break;
                case "TIME":
                    //SETS THE DEFAULT VALUE AS 0
                    list.children[7].value = '00:00';
                    break;
                case "TIMESTAMP":
                    child.value = '';

                    //SETS THE DEFAULT VALUE AS CURRENT
                    list.children[7].value = 'CURRENT_TIMESTAMP';
                    break;
                case "SET":
                    child.value = "Sim,Não";

                    //SETS THE DEFAULT VALUE AS 0
                    list.children[7].value = 'Sim';

                    //SETS THE SEARCH VALUE AS "NO"
                    list.children[15].value = 'N';
                    break;
                case "IMAGEM":
                    //SETS THE SEARCH VALUE AS "NO"
                    list.children[15].value = 'N';
                    child.value = "";
                    break;
                case "ARQUIVO":
                    //SETS THE SEARCH VALUE AS "NO"
                    list.children[15].value = 'N';
                    child.value = "";
                    break;
                default:
                    child.value = "";
                    break;
            }
        }
    }
</script>

<div id="instrucoes">
    <ul>
        <li>Table: Name of the Module to be created. (Ex: Products, location films, News Category).</li>
        <li>Has: Defines that this Module will relate with another Module (has_many, has_one). His value must be the name of that Module.</li>
        <li>Field: Name of the Module´s Field. (Ex: Title, text, image, Return Date). If it will be a Foreign Key, it must be a Integer Type, 
            rather "ID".</li>
        <li>Type: Type of the Module´s Field. (Ex: Integer, Date, File). If it will be "Password", do not add a "Retype Password" field 
            (the generator handle this).</li>
        <li>Size: Limit size of the Module´s Field. Sometimes is useless (Ex: Text Type).
            If it is Set Type, it must contains the possible values (Ex: Yes,No).</li>
        <li>Default: Default value of the field. If it will be a Foreign Key, it must be the field which names the refered Table (Ex: title, name).</li>
        <li>Primary: Defines the field as a Primary Key. It must be a Integer Type, rather "ID".</li>
        <li>Auto: Defines the field as "Auto Increment". Usually used on Primary Keys.</li>
        <li>Ref: Defines the field as a Foreign Key. His value must be the name of the refered Table.</li>
        <li>Search: Include the field in the search of the module, as like in the list.</li>
        <li>Required: Defines this field as required, and will have a Rule in the Model.</li>
        <li>It is good to know that the Image Type uses a Crop code, called JCrop, which can be useful (or not). It is up to you.</li>
        <li>Any directory path added, as well classes, ids and whatever are just to point the way. Feel free to adapt it to your patterns.</li>
        <li>The text fields uses the CKEditor. If you dont want it, just take it out.</li>
        <li>Some things will need your attention, like some javascript functions (to delete all, for example) and pagination, 
            which you need to have done.</li>
        <li>For more assistance, read the README.txt.</li>
    </ul>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $("#instrucoes").hide();

        $("#abreInstrucao").fancybox({
            onClosed: function() {
                $("#instrucoes").hide();
            },
            onStart: function() {
                $("#instrucoes").show();
            }
        });

        $("#instrucoes").fancybox();

    });
</script>

<!--STYLE (CHANGE IF NEEDED)-->
<style>
    body{
        margin: 0;
        width: 100%;
        overflow-x: hidden;
    }
    
    /*FORMS*/
    form.padrao {
        zoom: 1;
        margin: auto;
    }
    form.padrao:before,
    form.padrao:after {
        display: table;
        content: "";
    }
    form.padrao:after {
        clear: both;
    }
    form.padrao .item-form {
        zoom: 1;
        position: relative;
        margin-bottom: 12px;
        padding: 0 !important;
        width: 100%;
    }
    form.padrao .item-form:before,
    form.padrao .item-form:after {
        display: table;
        content: "";
    }
    form.padrao .item-form:after {
        clear: both;
    }
    form.padrao label, form.padrao span {
        /*clear: left;*/
        display: block;
        float: left;
        line-height: 24px;
        margin-right: 5px;
        text-align: right;
        width: 65px;
    }
    form.padrao label:after {
        content: ':';
    }
    form.padrao input,
    form.padrao textarea,
    form.padrao select {

    }
    form.padrao .pno{
        width: 50px;
    }
    form.padrao input {
        line-height: 20px;
    }
    form.padrao textarea {
        height: 120px;
        resize: none;
    }
    form.padrao em {
        color: #f00;
        display: block;
        float: left;
    }
    form.padrao p.legenda {
        clear: left;
        color: #767676;
        float: left;
        font-size: 11px !important;
        margin-left: 105px;
    }
    form.padrao button {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background-color: #d5a412;
        background-image: -moz-linear-gradient(top, #DBDBDB, #000000);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#DBDBDB), to(#000000));
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#DBDBDB', endColorstr='#000000', GradientType=0);
        border: 1px solid #73580a;
        color: #ffffff;
        float: right;
        font: bold 10px Arial, Helvetica, Verdana, sans-serif;
        margin-right: 5px;
        padding: 4px 10px;
        text-align: center;
        text-transform: uppercase;
    }
    form.padrao button:hover {
        background: #000000;
    }
    
    form.padrao fieldset {
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        border: 1px solid #4aaada;
        margin-bottom: 20px;
        padding: 15px;
    }

    form.padrao fieldset legend {
        font-size: 14px;
        font-weight: bold;
        color: #000066;
        padding: 3px 10px;
    }

    form.padrao input,
    form.padrao textarea,
    form.padrao select, form.padrao .cke_1 {
        background-color: #f2f2f2;
        background-image: -moz-linear-gradient(top, #ffffff, #dfdfdf);
        background-image: -ms-linear-gradient(top, #ffffff, #dfdfdf);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#dfdfdf));
        background-image: -webkit-linear-gradient(top, #ffffff, #dfdfdf);
        background-image: -o-linear-gradient(top, #ffffff, #dfdfdf);
        background-image: linear-gradient(top, #ffffff, #dfdfdf);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dfdfdf', GradientType=0);
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        border: 1px solid #e0e0e0;
        float: left;
        font-family: Arial, Helvetica, Verdana, sans-serif;
        font-size: 11px;
        padding: 2px;
        width: 65px;
    }

    form.padrao .cke_1{
        width: 400px;
    }

    form.padrao input[type=radio], form.padrao input[type=checkbox]{
        width: 20px;
    }

    form.padrao span{
        float: left;
    }
    /*END FORMS*/

    .menos, .mais{
        margin-left: 10px;
    }

    .cod{
        text-align: right;
    }
</style>
<!--END STYLE-->

<!--SCRIPTS FORMS-->
<script>
    $(document).ready(function() {

        $("a[rel=grupo_imagens]").fancybox();

        $("#limpar").click(function(event) {
            event.preventDefault();
            document.form_cadastro.reset();
        });

        $("#cadastrar").click(function(event) {
            event.preventDefault();
            $("#form_cadastro").submit();
        });

        $("#form_cadastro").submit(function(){
            $("#envies").show('slow');
            $.post('<?php echo $config["urlForm"] ?>', $(this).serialize(), function(data) {
                $("#envies").hide("slow");
                if (data.ok === "OK") {
                    alert("CRUD generated!");
                    //document.form_cadastro.reset();
                } else if (data.ok === "NOPE") {
                    alert('Houston, we have a problem!!');
                }
            }, 'json');
            return false;
        });
    });
</script>
<!--END SCRIPTS FORMS-->