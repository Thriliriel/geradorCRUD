<div id="interno">
    <h1>Generate CRUD</h1>

    <p><a href="#instrucoes" id="abreInstrucao" >How to</a></p>
    
    <p>To generate the CRUD, fill below:</p>

    <form class="padrao" id="form_cadastro" name="form_cadastro" method="post">
        <fieldset>
            <legend>Module</legend>
            <div class="item-form">
                <label for="fTabela">Table</label>
                <input type="text" id="fTabela" name="fTabela" />
            </div>
        </fieldset>

        <fieldset>
            <legend>Fields</legend>
            <div class="item-form" >
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

                <img src="<?php echo url::base(); ?>imgs/bt_mais.png" class="mais" onclick="maisCampo()" />
                <img src="<?php echo url::base(); ?>imgs/bt_menos.png" class="menos" onclick="menosCampo()" />
            </div>
        </fieldset>

        <button type="submit" id="cadastrar">Send</button>
        <button type="reset" id="limpar">Clean</button>
    </form>
    <div id="envies" style="color: red; display: none;">Wait...</div>
</div>

<script type="text/javascript">
    //FIELDS COUNT
    var total = 1;
    
    //NEW FIELD
    var campo = '<div class="item-form" >'+
        '<label for="fCampo">Field</label>'+
        '<input type="text" id="fCampo" name="fCampo[]" value="" />'+
        '<label for="fTipo">Type</label>'+
        '<select id="fTipo" name="fTipo[]" onchange="setTamanho(this)">'+
        '<option value="VARCHAR" selected>String</option>'+
        '<option value="PASSWORD">Password</option>'+
        '<option value="TEXT">Text</option>'+
        '<option value="INT">Integer</option>'+
        '<option value="DECIMAL">Values (ex: 39,67)</option>'+
        '<option value="DATE">Date</option>'+
        '<option value="TIME">Hour</option>'+
        '<option value="TIMESTAMP">Date and Hour</option>'+
        '<option value="SET">Set (ex: Yes or No)</option>'+
        '<option value="IMAGEM">Image</option>'+
        '<option value="ARQUIVO">File (ex: DOC or PDF)</option>'+
        '</select>'+
        '<label for="fTamanho">Size</label>'+
        '<input type="text" class="pno" id="fTamanho" name="fTamanho[]" value="" />'+
        '<label for="fDefault">Default</label>'+
        '<input type="text" id="fDefault" name="fDefault[]" value="" />'+
        '<label for="fPrimaria">Primary</label>'+
        '<select id="fPrimaria" name="fPrimaria[]" style="width: 60px;" >'+
            '<option value="S">Yes</option>'+
            '<option value="N" selected>No</option>'+
        '</select>'+
        '<label for="fAuto">Auto</label>'+
        '<select id="fAuto" name="fAuto[]" style="width: 60px;" >'+
            '<option value="S">Yes</option>'+
            '<option value="N" selected>No</option>'+
        '</select>'+
        '<label for="fRef">Ref</label>'+
        '<input type="text" id="fRef" name="fRef[]" value="" />'+
        '<label for="fPesquisar">Search</label>'+
        '<select id="fPesquisar" name="fPesquisar[]" style="width: 60px;" >'+
            '<option value="S">Yes</option>'+
            '<option value="N" selected>No</option>'+
        '</select>'+
        '</div>';
    
    function maisCampo(){
        $(".item-form").last().after(campo);
        total++;
    }
    
    function menosCampo(){
        if(total > 1){
            $(".item-form").last().remove();
            total--;
        }
    }
    
    function setTamanho(put){
        var list = put.parentNode;
        if (list.children) {
            var child = list.children[5];
            
            //SETA O VALOR DEFAULT COMO VAZIO
            list.children[7].value = "";
            
            //SETA O VALOR PRIMARIO COMO "NAO"
            list.children[9].value = "N";
            
            //SETA O VALOR AUTO INCREMENT COMO "NAO"
            list.children[11].value = "N";
            
            switch(put.value){
                case "VARCHAR":
                    child.value = 100;
                    break;
                case "PASSWORD":
                    child.value = 32;
                    break;
                case "INT":
                    child.value = 11;
                    //SET THE DEFAULT VALUE TO 0
                    list.children[7].value = 0;            
                    break;
                case "DECIMAL":
                    child.value = "10,2";
                    //SET THE DEFAULT VALUE TO 0
                    list.children[7].value = 0;
                    break;
                case "DATE":
                    //SET THE DEFAULT VALUE TO EMPTY
                    list.children[7].value = '';
                    break;
                case "TIME":
                    //SET THE DEFAULT VALUE TO 0
                    list.children[7].value = '00:00';
                    break;
                case "TIMESTAMP":
                    child.value = '';
                    
                    //SET THE DEFAULT VALUE TO CURRENT
                    list.children[7].value = 'CURRENT_TIMESTAMP';
                    break;
                case "SET":
                    child.value = "Yes,No";
                    
                    //SET THE DEFAULT VALUE TO YES
                    list.children[7].value = 'Yes';
                    
                    //SET THE SEARCH TO BLOCKED
                    list.children[15].value = 'N';
                    break;
                case "IMAGEM":
                    //SET THE SEARCH TO BLOCKED
                    list.children[15].value = 'N';
                    child.value = "";
                    break;
                case "ARQUIVO":
                    //SET THE SEARCH TO BLOCKED
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
        <li>It is good to know that the Image Type uses a Crop code, called JCrop, which can be useful (or not). It is up to you.</li>
        <li>Any directory path added, as well classes, ids and whatever are just to point the way. Feel free to adapt it to your patterns.</li>
        <li>The text fields uses the CKEditor. If you dont want it, just take it out.</li>
        <li>Some things will need your attention, like some javascript functions (to delete all, for example) and pagination, 
            which you need to have done.</li>
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