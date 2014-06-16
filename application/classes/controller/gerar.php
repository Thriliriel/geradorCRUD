<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Gerar extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - GERAR";
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index() {
        $view = View::Factory('gerar');

        $this->template->bt_voltar = true;

        $this->template->conteudo = $view;
    }

    //MAKE THE MAGIC =P
    public function action_salvar() {
        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            //TAKE POSTS
            $post = $this->request->post();

            $tabela = strtoupper($this->trataTxt($post['fTabela']));
            
            //TAKE THE 3 FIRST CARACTERES OF THE TABLE
            if (strpos($tabela, "_")) {
                $temp = explode("_", $tabela);
                $carc = substr($temp[0], 0, 2);
                $carc .= substr($temp[1], 0, 1);
                //SET "_" AS SEPARATOR
                $separador = "_";
            } else if (strpos($tabela, " ")) {
                $temp = explode(" ", $tabela);
                $carc = substr($temp[0], 0, 2);
                $carc .= substr($temp[1], 0, 1);
                //SET "_" AS SEPARATOR
                $separador = " ";
            } else {
                $carc = substr($tabela, 0, 3);
                //FOR DEFAULT, SET "_" AS SEPARATOR
                $separador = "_";
            }

            //CREATE FOLDERS
            if (!is_dir("upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))))) {
                mkdir("upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))), 0777);
                mkdir("upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/controller", 0777);
                mkdir("upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view", 0777);
                mkdir("upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))), 0777);
            }

            //GENERATES CONTROLLER
            // FILE´S FOLDER
            $filename = "upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/controller/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ".php";

//NEW TEXT
            $controlador = '<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_' . ucwords(strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela'])))) . ' extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - ' . ucwords(strtolower($post['fTabela'])) . '";
        
        //GENERATES TABLE
        $this->db->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS ' . str_replace(" ", "_", $tabela) . ' (
            '; 
            
            //PRIMARY KEYS
            $id = array();
            $primary = '';
            $foreign = '';
            
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF TYPE IS IMAGE OR FILE, DO NOT ADD IN THE DATABASE
                        if ($post["fTipo"][$i] != "IMAGEM" and $post["fTipo"][$i] != "ARQUIVO") {

                            $def = "";
                            $tam = "";

                            //IF THERE IS A DEFAULT VALUE AND IT IS NOT FOREIGN KEY, SET ON TABLE
                            if ($post["fDefault"][$i] != "" and $post["fRef"][$i] == "") {
                                //IF IT IS SET TYPE, USES JUST THE FIRST LETTER
                                if($post["fTipo"][$i] == "SET"){
                                    $def = ' default \'' . substr($post["fDefault"][$i], 0, 1) . '\'';
                                }else if($post["fTipo"][$i] == "TIMESTAMP"){
                                    //IF IT IS TIMESTAMP TYPE, DO NOT USE QUOTES
                                    $def = ' default ' . $post["fDefault"][$i] . '';
                                }else{
                                    $def = ' default \'' . $post["fDefault"][$i] . '\'';
                                }
                            }

                            //SET SIZE, IF ANY, OR IF IT IS DECIMAL/SET
                            if (($post["fTamanho"][$i] > 0) or ($post["fTipo"][$i] == "DECIMAL" or $post["fTipo"][$i] == "SET")) {
                                //IF IT IS SET TYPE, USES JUST THE FIRST LETTER OF EACH VALUE
                                if($post["fTipo"][$i] == "SET"){
                                    $valoresSet = explode(",", $post['fTamanho'][$i]);
                                    
                                    $tam = '(';
                                    
                                    $g = 0;
                                    foreach($valoresSet as $vas){
                                        if($g > 0)  $tam .= ",";
                                        $tam .= '\''.substr($vas, 0, 1).'\'';
                                        $g++;
                                    }
                                    
                                    $tam .= ')';
                                }else{
                                    $tam = '(' . $post['fTamanho'][$i] . ')';
                                }
                            }

                            //IF IT IS FOREIGN KEY, USES THE PREFIX OF THE REFERED TABLE. ELSE, JUST A REGULAR FIELD
                            if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                                if (strpos($post["fRef"][$i], "_")) {
                                    $temp = explode("_", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                }
                                
                                $campoTabela = strtoupper($carcEst)."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                                
                                //ADD TO VAR TO USE THIS CONSTRAINT IN THE END
                                $foreign .= ',
            FOREIGN KEY ('.$campoTabela.') REFERENCES '.strtoupper($post["fRef"][$i]).'('.$campoTabela.') ON DELETE CASCADE ON UPDATE CASCADE';
                            }else{
                                $campoTabela = $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                            }
                            
                            //IF IT IS PRIMARY KEY, ADD THE FIELD. ELSE, ADD AS NORMAL
                            if($post["fPrimaria"][$i] == "S"){
                                
                                if($primary != ""){
                                    $primary .= ', ';
                                }
                                
                                $primary .= $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                                
                                //ADD THE PRIMARY KEY IN THE ARRAY $ID
                                array_push($id, strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                                
                                //IF IT IS AUTO INCREMENT, SET THIS
                                if($post["fAuto"][$i] == "S"){
                                    $auto = ' auto_increment';
                                }else{
                                    $auto = '';
                                }
                                
            $controlador .= $campoTabela . ' ' . $post['fTipo'][$i] . ' ' . $tam . ' unsigned NOT NULL'.$auto.',
            ';
                            }else{
                                
                                //IF IT IS FOREIGN KEY, ADD THE UNSIGNED
                                if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                    $unsig = ' unsigned';
                                }else{
                                    $unsig = '';
                                }
                                
                                //IF IT IS PASSWORD TYPE, DO NOT ADD THE POST, BUT VARCHAR
                                if($post['fTipo'][$i] == "PASSWORD"){
            $controlador .=  $campoTabela. ' VARCHAR ' . $tam . $unsig.' NOT NULL' . $def . ',
            ';
                                }else{
            $controlador .=  $campoTabela. ' ' . $post['fTipo'][$i] . ' ' . $tam . $unsig.' NOT NULL' . $def . ',
            ';
                                }
                                
            
                            }
                        }
                    }
                }
            }

            $controlador .= 'PRIMARY KEY  (' . $primary . ')'.$foreign.'
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCE THE LIST VIEW AS DEFAULT
        $view = View::Factory("' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/list");
        
        $where = "";
        
        //CHECK IF THERE IS SOME SEARCH
        if(isset($_GET["chave"])){
            ';

            $operador = "";
            $itemPesquisa = "";

            //FILL THE SEARCH WITH THE MARKED FIELDS
            if (array_key_exists('fPesquisar', $post)) {
                if (is_array($post['fPesquisar'])) {
                    $max = count($post['fPesquisar']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S") {
                            //CHECK THE FIELD´S TYPE, TO DO THE RIGHT SEARCH
                            $tipo = $post['fTipo'][$i];
                            if ($tipo == "DATE") {
                                $valorCampo = '$this->ddmmaaaa_aaaammdd(addslashes($_GET["chave"]))';
                            } else if ($tipo == "DECIMAL") {
                                $valorCampo = 'str_replace(",", ".", str_replace(".", "", $_GET["chave"]))';
                            } else {
                                $valorCampo = '$_GET["chave"]';
                            }

                            if ($operador == "") {
                                $operador = " where ";
                                $itemPesquisa = '$where .= "';
                            } else if ($operador == " where ") {
                                $operador = " or ";
                            }
                            $itemPesquisa .= $operador . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . ' like \'%".' . $valorCampo . '."%\'';
                        }
                    }
                }
            }

            $controlador .= $itemPesquisa;
            if($itemPesquisa != ""){
                $controlador .= '";';
            }

            $controlador .= '
        }
        
        //TAKE THE DATA
        $paginas = $this->action_page("select * from ' . str_replace(" ", "_", $tabela) . ' ".$where." order by ' . $carc . '_' . strtoupper($this->trataTxt($post['fCampo'][0])) . ' desc", $this->qtdPagina);
        $view->' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = $paginas["data"];
        $view->pagination = $paginas["pagination"];
        
        //PASS THE MESSAGE, IF ANY
        $view->mensagem = $mensagem;
        $view->erro = $erro;
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }

    //EDIT FORM
    public function action_edit(){
        //INSTANCE THE EDIT VIEW
        $view = View::Factory("' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/edit");
        
        $id = $this->request->param("id");
        ';
        
        //IF THERE IS SOME FOREIGN KEY, BRING THE DATA
        if (array_key_exists('fRef', $post)) {
            if (is_array($post['fRef'])) {
                $max = count($post['fRef']);
                for ($i = 0; $i < $max; $i++) {
                    if ($post['fRef'][$i] != "" and $post['fTipo'][$i] == "INT") {
                        //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                        if (strpos($post["fRef"][$i], "_")) {
                            $temp = explode("_", $post["fRef"][$i]);
                            $carcEst = substr($temp[0], 0, 2);
                            $carcEst .= substr($temp[1], 0, 1);
                        } else {
                            $carcEst = substr($post["fRef"][$i], 0, 3);
                        }
                                
                        $controlador .= '
        //BRING '.strtoupper($post['fRef'][$i]).'
        $view->'.strtolower($post['fRef'][$i]).' = $this->db->query(Database::SELECT, "select * from '.strtoupper($post['fRef'][$i]).' order by '.strtoupper($carcEst)."_".strtoupper($post['fDefault'][$i]).' asc");
                            ';
                    }
                }
            }
        }
            
        $controlador .= '
        //IF THE ID EXISTS, BRING THE DATA
        if($id){
            //BRING THE DATA AND FILL THE FIELDS
            $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = $this->db->query(Database::SELECT, "select * from ' . str_replace(" ", "_", $tabela) . ' where ' . $carc . '_'.$id[0].' = ".addslashes($id));
            ';

            $controlador .=
                    '$arr = array(';

            //FILL THE TABLE FIELD´S ARRAY
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF IT IS IMAGE, FILE OR PASSWORD TYPE, DO NOT ADD IN THE ARRAY
                        if ($post["fTipo"][$i] != "IMAGEM" and $post["fTipo"][$i] != "ARQUIVO" and $post["fTipo"][$i] != "PASSWORD") {
                            
                            //CHECK IF IS A FOREIGN KEY. IF IS, ADD THE PREFIX OF THIS TABLE
                            if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                                if (strpos($post["fRef"][$i], "_")) {
                                    $temp = explode("_", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                }
                                
                                $campoTabela = strtoupper($carcEst)."_".strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                            }else{
                                $campoTabela = $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                            }
                            
                            //IF IT IS TIMESTAMP TYPE, DO NOT EDIT
                            if($post["fTipo"][$i] != "TIMESTAMP"){
                $controlador .= '
                "' . $campoTabela . '" => $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '[0]["' . $campoTabela . '"],';
                            }
                        }
                    }
                }
            }

            $controlador .= '
            );
            
            $view->' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = $arr;';
                
            //IF THERE IS IMAGE, ADD TO BRING IT
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                //IMAGE COUNT
                $maxImagem = 0;
                $extraImagem = '';
                
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        //IF IT IS NOT THE FIRST IMAGE, IT NEEDS A DIFERENT NAME TO SAVE
                        if($maxImagem > 0){
                            $extraImagem = strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_';
                        }
                        
                        $controlador .= '
                    
            //BRING THE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).', IF ANY
            $'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'thumb_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '[0]["'.$carc.'_'.$id[0].'"] . ".*");
            if ($'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).') {
                $view->'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = "<div class=\'item-form\'>
                        <label>Delete '.ucwords(($post["fCampo"][$i])).'</label>
                        <input type=\'checkbox\' id=\'excluir'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'\' name=\'excluir'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'\'>
                        <img src=\'" . url::base() . $'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'[0] . "\'>
                    </div>";
            }
            else {
                $view->'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = false;
            }';
                        
                        //INCREMENT
                        $maxImagem++;
                    }
                }
            }
            
            //IF THERE IS FILE, ADD TO BRING
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
                    
            //BRING THE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).', IF ANY
            $'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '[0]["'.$carc.'_'.$id[0].'"] . ".*");
            if ($'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).') {
                $view->'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = "<div class=\'item-form\'>
                        <label>Delete '.ucwords(($post["fCampo"][$i])).'</label>
                        <input type=\'checkbox\' id=\'excluir'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'\' name=\'excluir'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'\'>
                        File Exists!!
                    </div>";
            }
            else {
                $view->'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = false;
            }';
                    }
                }
            }
            
            $controlador .= '
        }else{
            //ELSE, SET AS EMPTY
            $arr = array( 
                "' . $carc . '_'.$id[0].'" => "0",';

            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF IT IS IMAGE, FILE OF PASSWORD TYPE, OR A PRIMARY KEY, DO NOT ADD IN THE ARRAY
                        if ($post["fTipo"][$i] != "IMAGEM" and $post["fTipo"][$i] != "ARQUIVO" and $post["fTipo"][$i] != "PASSWORD" 
                                and $post["fPrimaria"][$i] != "S") {
                            
                            //CHECK IF IT IS A FOREIGN KEY. IF IS, ADD THE PREFIX OF THIS TABLE
                            if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                //TAKE THE 3 FIRST CARACTERS OF THIS TABLE
                                if (strpos($post["fRef"][$i], "_")) {
                                    $temp = explode("_", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                }
                                
                                $campoTabela = strtoupper($carcEst)."_".strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                            }else{
                                $campoTabela = $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                            }
                            
                            //IF IT IS DATA, TIME, SET OR FOREIGN KEY, USE THE PHP DEFAULT. ELSE, PUT HERE
                            //IF IT IS TIMESTAMP, DO NOT EDIT
                            if($post["fTipo"][$i] != "TIMESTAMP"){
                                if($post["fTipo"][$i] == "DATE"){
                                $controlador .= '
                "' . $campoTabela . '" => date("Y-m-d"),';
                                }else if($post["fTipo"][$i] == "TIME"){
                                $controlador .= '
                "' . $campoTabela . '" => date("G:i"),';
                                }else if($post["fTipo"][$i] == "SET"){
                                $controlador .= '
                "' . $campoTabela . '" => "' . substr($post["fDefault"][$i], 0, 1) . '",';
                                }else if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                $controlador .= '
                "' . $campoTabela . '" => "",';
                                }else{
                                $controlador .= '
                "' . $campoTabela . '" => "' . $post["fDefault"][$i] . '",';
                                }
                            }
                        }
                    }
                }
            }

            $controlador .= '
            );
            
            $view->' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = $arr;';
            
            //IF THERE IS IMAGE, ADD TO SET IT AS FALSE
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE TYPE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        $controlador .= '
            $view->'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = false;';
                    }
                }
            }
            
            //IF THERE IS FILE, ADD TO SET IT AS FALSE
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
            $view->'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = false;';
                    }
                }
            }
            
            $controlador .= '
        }
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }
    
    //SAVE DATA
    public function action_save(){
        //TAKE THE FIELDS
        foreach($this->request->post() as $campo => $value){
            ';
            
            //CHECK IF EXISTS PASSWORD, TO IGNORE THE CONFIRMATION
            if(in_array("PASSWORD", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                $controlador .= 'if(';
                
                $flag42 = "";
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS PASSWORD TYPE, ADD THE IF
                    if ($post["fTipo"][$i] == "PASSWORD") {
                        $controlador .= $flag42.' $campo != "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C"';
                        if($flag42 == ""){
                            $flag42 = " and";
                        }
                    }
                }
                
                $controlador .= '){
            ';
            }
            
            //DEFINE THE ITENS, TO ARRANGE THE FIELDS
            $default = '';
            $flag = "if";
            $qntCampos = 0;

            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF IT IS FILE TYPE, OR PRIMARY KEY, DO NOT ADD IN ARRAY. IF IT IS IMAGE TYPE, DO NOTHING
                        if ($post["fTipo"][$i] != "ARQUIVO"
                                and $post["fPrimaria"][$i] != "S" and $post["fAuto"][$i] != "S") {
                            $tipo = $post['fTipo'][$i];
                            if ($tipo == "DATE") {
                                $default .= $flag . ' ($campo == "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '") {
                $valores[$campo] = ("\'" . $this->ddmmaaaa_aaaammdd(addslashes($value)) . "\'");
            }';
                                $flag = "else if";
                                $qntCampos++;
                            } else if ($tipo == "DECIMAL") {
                                $default .= $flag . ' ($campo == "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '") {
                $valores[$campo] = ("\'" . str_replace(",", ".", str_replace(".", "", $value)) . "\'");
            }';
                                $flag = "else if";
                                $qntCampos++;
                            } else if ($tipo == "PASSWORD") {
                                $default .= $flag.' ($campo == "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '") {
                //CHECK EMPTY PASSWORD, DO NOT SAVE SO
                if ($value == "") {
                    continue;
                }
                else {
                    if ($value == $this->request->post("' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C"))
                        $valores[$campo] = ("\'" . md5(hash("sha512", Cookie::$salt . addslashes($value))) . "\'");
                }
            }';
                                $flag = "else if";
                                $qntCampos++;
                            } else if ($tipo == "IMAGEM") {
                                $default .= $flag . ' ($campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Blob" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'x1" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'y1" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'w" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'h") {
                //DO NOT SAVE ON DATABASE, IT IS THE IMAGE FIELD
            }';
                                $flag = "else if";
                                $qntCampos++;
                            }
                        }
                    }

                    //IF IT FOUND ONE, MADE THE IF/ELSE. OTHERWISE, SET THE DEFAULT VALUE
                    if ($qntCampos > 0) {
                        $default .= 'else{ 
                $valores[$campo] = ("\'".addslashes($value)."\'"); 
            }';
                    } else {
                        $default = '$valores[$campo] = ("\'".addslashes($value)."\'");';
                    }

                    $controlador .= $default;
                    
                    //IF IT HAS PASSWORD, CLOSE THE IF UP ABOVE
                    if(in_array("PASSWORD", $post["fTipo"])){
                        $controlador .= '
            }';
                    }
                }
            }

            $controlador .= '
        }
';

            $controlador .=
                    '
        //IF ID IS EMPTY, INSERT
        if($valores["' . $carc . '_'.$id[0].'"] == "\'0\'" ){            
            //INSERT
            $query = $this->db->query(Database::INSERT, "insert into ' . str_replace(" ", "_", $tabela) . '(".$this->implode_keys(",", $valores).") 
                values(".implode(",", $valores).")");';
            
            //IF THERE IS IMAGE, ADD IT
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                //IMAGE COUNT
                $maxImagem = 0;
                $extraImagem = '';
                
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE TYPE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        
                        //IF IT IS NOT THE FIRST IMAGE, NEED A DIFFERENT NAME
                        if($maxImagem > 0){
                            $extraImagem = strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_';
                        }
                        
                        $controlador .= '
                            
            //INSERT THE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).', IF ANY
            if ($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob") != "") {
                $imgBlob = $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob");
                
                if(strpos($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob"), "image/jpg") or strpos($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob"), "image/jpeg")){
                    //JPEG
                    $imgBlob = str_replace("data:image/jpeg;base64,", "", $imgBlob);
                    $ext = "jpg";
                }else if(strpos($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob"), "image/png")){
                    //PNG
                    $imgBlob = str_replace("data:image/png;base64,", "", $imgBlob);
                    $ext = "png";
                }
                
                $imgBlob = str_replace(" ", "+", $imgBlob);
                $data = base64_decode($imgBlob);
                
                //ORIGINAL IMAGE
                $imgName = "'.$extraImagem.'".$query[0] . ".".$ext;
                file_put_contents(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName, $data);
                    
                //CROP
                if($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") != "" and $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") > 0){
                    $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                    $img = $img->crop($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'h"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'x1"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'y1"))->save(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                }
                
                //THUMB
                $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                $imgName = "'.$extraImagem.'thumb_" . $query[0] . ".".$ext;
                $img->resize(200)->save(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
            }';
                        
                        //INCREMENT
                        $maxImagem++;
                    }
                }
            }
            
            //IF THERE IS FILE, ADD IT
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
                            
            //INSERT THE FILE, IF ANY
            if ($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"] != "") {

                $ext = explode(".", $_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"]);
                $arqName = "'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_".$query[0] . "." . $ext[count($ext) - 1];

                if($ext[count($ext) - 1] == "doc" or $ext[count($ext) - 1] == "docx" or $ext[count($ext) - 1] == "pdf"){
                    copy($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["tmp_name"], DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$arqName);
                }
            }';
                    }
                }
            }
            
        $controlador .= '
        }else{
            //ELSE, UPDATE
            $sql = "";';
            
            //IF THERE IS IMAGE OR FILE, ADD THE VARS AND ARRANGE THE SQL TO NOT TAKE IT
            $addSql = '';
            $op = 'if';
            
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE TYPE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        $controlador .= '
            $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' = false;
                ';
                        $addSql .= $op.' ($it == "excluir'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'") {
                    $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' = str_replace("\'", "", $va);
                }';
                        $op = 'else if';
                    }
                }
            }
            
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
            $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' = false;
                ';
                        $addSql .= $op.' ($it == "excluir'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'") {
                    $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' = str_replace("\'", "", $va);
                }';
                        $op = 'else if';
                    }
                }
            }
            
            //IF $addSql IS EMPTY, DO NOT HAS IMAGE NEITHER FILE, SO, SET AS NORMAL. ELSE, ADD THE LAST ELSE/IF
            if($addSql == ""){
                $addSql = '$sql .= $it." = ".$va.",";';
            }else{
                $addSql .= 'else{
                    $sql .= $it . " = " . $va . ",";
                }';
            }
        
            $controlador .= '
            //FILL SQL
            foreach($valores as $it => $va){
                '.$addSql.'
            }
            //ALTER
            $query = $this->db->query(Database::UPDATE, "update ' . str_replace(" ", "_", $tabela) . ' set ".substr($sql, 0, strlen($sql)-1)." where ' . $carc . '_'.$id[0].' = 
                ".$valores["' . $carc . '_'.$id[0].'"]);';
            
            //IF THERE IS IMAGE, CHECK TO DELETE AND SAVE
            $queryExtra = "";
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                //IMAGE COUNT
                $maxImagem = 0;
                $extraImagem = '';
                
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE TYPE, ADD THE ITENS
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        //IF IT IS NOT THE FIRST IMAGE, NEEDS A DIFFERENT NAME
                        if($maxImagem > 0){
                            $extraImagem = strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_';
                        }
                        
                        $controlador .= '
                            
            //IF DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' IS CHECKED, DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'
            if($exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' == "on" or $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob") != ""){
                $imgsT = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'thumb_" . str_replace("\'", "", $valores["' . $carc . '_'.$id[0].'"]) . ".*");
                $imgs = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'" . str_replace("\'", "", $valores["' . $carc . '_'.$id[0].'"]) . ".*");
                
                if($imgs){
                    foreach($imgs as $im){
                        unlink($im);
                    }
                }

                if($imgsT){
                    foreach($imgsT as $imT){
                        unlink($imT);
                    }
                }
            }
            
            //INSERT THE IMAGE, IF ANY
            if ($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob") != "") {
                $imgBlob = $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob");
                
                if(strpos($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob"), "image/jpg") or strpos($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob"), "image/jpeg")){
                    //JPEG
                    $imgBlob = str_replace("data:image/jpeg;base64,", "", $imgBlob);
                    $ext = "jpg";
                }else if(strpos($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob"), "image/png")){
                    //PNG
                    $imgBlob = str_replace("data:image/png;base64,", "", $imgBlob);
                    $ext = "png";
                }
                
                $imgBlob = str_replace(" ", "+", $imgBlob);
                $data = base64_decode($imgBlob);
                
                //ORIGINAL IMAGE
                $imgName = "'.$extraImagem.'".str_replace("\'", "", $valores["' . $carc . '_'.$id[0].'"]) . ".".$ext;
                file_put_contents(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName, $data);
                    
                //CROP
                if($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") != "" and $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") > 0){
                    $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                    $img = $img->crop($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'h"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'x1"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'y1"))->save(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                }
                
                //THUMB
                $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                $imgName = "'.$extraImagem.'thumb_" . str_replace("\'", "", $valores["' . $carc . '_'.$id[0].'"]) . ".".$ext;
                $img->resize(200)->save(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
            }';
                        
                        //ADD THE IMAGE ITENS TO CHECK ON THE IF(QUERY)
                        $queryExtra .= ' or $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'Blob") != "" or $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                        
                        //INCREMENT
                        $maxImagem++;
                    }
                }
            }
            
            //IF THERE IS FILE, CHECK THE DELETE AND SAVE
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD ITENS
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
            //IF DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' IS CHECKED, DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'
            if($exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' == "on" or $_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"] != ""){
                $arq = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_" . str_replace("\'", "", $valores["' . $carc . '_'.$id[0].'"]) . ".*");
                
                if($arq){
                    foreach($arq as $ar){
                        unlink($ar);
                    }
                }
            }
            
            //INSERT '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).', IF ANY
            if ($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"] != "") {
                
                $ext = explode(".", $_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"]);
                $arqName = "'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_".str_replace("\'", "", $valores["' . $carc . '_'.$id[0].'"]) . "." . $ext[count($ext) - 1];

                if($ext[count($ext) - 1] == "doc" or $ext[count($ext) - 1] == "docx" or $ext[count($ext) - 1] == "pdf"){
                    copy($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["tmp_name"], DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$arqName);
                }
            }';
                        
                        //ADD THE IMAGE ITENS TO CHECK ON THE IF(QUERY)
                        $queryExtra .= ' or $_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"] != "" or $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                    }
                }
            }
            
            $controlador .= '
        }
        
        //IF IT WORKED, COME BACK TO LIST WITH OK MESSAGE
        if($query'.$queryExtra.'){
            $this->action_index("Data changed!", false);
        }else{
            //ELSE, COME BACK WITH THE ERROR MESSAGE
            $this->action_index("There was some problem, no changes made!", true);
        }
    }
    
    //DELETE DATA
    public function action_excluir(){';
        
            //IF THERE IS IMAGE, DELETE
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                //IMAGE COUNT
                $maxImagem = 0;
                $extraImagem = '';
                
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE TYPE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        //IF IT IS NOT THE FIRST IMAGE, NEED A DIFFERENT NAME
                        if($maxImagem > 0){
                            $extraImagem = strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_';
                        }
                        
                        $controlador .= '
        //DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'
        $imgsT = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'thumb_" . $this->request->param("id") . ".*");
        $imgs = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'" . $this->request->param("id") . ".*");

        if($imgs){
            foreach($imgs as $im){
                unlink($im);
            }
        }

        if($imgsT){
            foreach($imgsT as $imT){
                unlink($imT);
            }
        }';
                        //INCREMENT
                        $maxImagem++;
                    }
                }
            }
            
            //IF THERE IS FILE, DELETE
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
        //DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'
        $arq = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_" . $this->request->param("id") . ".*");

        if($arq){
            foreach($arq as $ar){
                unlink($ar);
            }
        }';
                    }
                }
            }
            
            $controlador .= '
        //DELETE
        $query = $this->db->query(Database::DELETE, "delete from ' . str_replace(" ", "_", $tabela) . ' where ' . $carc . '_'.$id[0].' = ".$this->request->param("id"));
        
        //IF IT WORKED, COME BACK TO LIST WITH OK MESSAGE
        if($query){
            $this->action_index("Data deleted!", false);
        }else{
            //ELSE, COME BACK TO LIST WITH THE ERROR MESSAGE
            $this->action_index("There was some problem!", true);
        }
    }
    
    //DELETE ALL CHECKED DATA
    public function action_excluirTodos() {
        $query = false;
        
        foreach ($this->request->post() as $value) {
            foreach($value as $val){';
            
            //IF THERE IS IMAGE, DELETE
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                //IMAGE COUNT
                $maxImagem = 0;
                $extraImagem = '';
                
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS IMAGE TYPE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        
                        //IF IT IS NOT THE FIRST IMAGE, NEED A DIFFERENT NAME
                        if($maxImagem > 0){
                            $extraImagem = strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_';
                        }
                        
                        $controlador .= '
                //DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'
                $imgsT = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'thumb_" . $val . ".*");
                $imgs = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'" . $val . ".*");

                if($imgs){
                    foreach($imgs as $im){
                        unlink($im);
                    }
                }

                if($imgsT){
                    foreach($imgsT as $imT){
                        unlink($imT);
                    }
                }';
                        
                        //INCREMENT
                        $maxImagem++;
                    }
                }
            }
            
            //IF THERE IS FILE, DELETE
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS FILE TYPE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
                //DELETE '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'
                $arq = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_" . $val . ".*");

                if($arq){
                    foreach($arq as $ar){
                        unlink($ar);
                    }
                }';
                    }
                }
            }
            
            $controlador .= '
                //DELETE
                $query = $this->db->query(Database::DELETE, "delete from ' . str_replace(" ", "_", $tabela) . ' where ' . $carc . '_'.$id[0].' = " . $val);
            }
        }
        
        //IF IT WORKED, COME BACK TO LIST WITH OK MESSAGE
        if ($query) {
            $this->action_index("Data deleted!", false);
        }
        else {
            //ELSE, COME BACK TO LIST WITH THE ERROR MESSAGE
            $this->action_index("There was some problem!", true);
        }
    }
    
    //SEARCH FUNCTION
    public function action_pesquisa(){
        $this->action_index("", false);
    }

}

// End '.$post['fTabela'].'
';

            //SAVING
            $file = fopen($filename, "w+");
            fwrite($file, stripslashes($controlador));
            fclose($file);


            //EDIT FORM
            // FILE PATH
            $filename = "upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/edit.php";

//START EDIT FORM
            $edicao = '<section id="formulario">
    <h1>' . (str_replace("_", " ", $post['fTabela'])) . '</h1>
    <form action="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/save" class="padrao" id="formEdit" name="formEdit" method="post"';
            
            //IF THERE IS FILE, ADD THE ENCTYPE
            if(in_array("ARQUIVO", $post["fTipo"])){
                $edicao .= ' enctype="multipart/form-data" ';
            }
            
            $edicao .= '>
	
        <!--IF NECESSARY, INFORMATIONS-->
        <!--<p></p>-->

        <input type="hidden" id="' . $carc . '_'.$id[0].'" readonly name="' . $carc . '_'.$id[0].'" value="<?php echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_'.$id[0].'"] ?>">
    ';

            $idImagem = false;
            
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF IT IS PRIMARY KEY, DO NOT ADD CAUSE IT WAS ADDED ABOVE
                        if($post['fPrimaria'][$i] != "S"){
                            //FIELD´S TYPES (TEXT, STRING, SELECT...)
                            switch ($post['fTipo'][$i]) {
                                case "VARCHAR":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .= '
            <input type="text" value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .= '
        </div>
                            ';
                                    break;
                                case "PASSWORD":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .= '
            <input type="password" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .= '
        </div>
        
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C">Confirmar ' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .= '
            <input type="password" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C">';

            $edicao .= '
        </div>
                            ';
                                    break;
                                case "TEXT":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <textarea class="ckeditor" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">
                <?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] ?>
            </textarea>';

            $edicao .=
            '
        </div>
                                        ';
                                    break;
                                case "INT":
                                    //CHECK IF IT IS FOREIGN KEY. IF YES, ADD THE PREFIX OF THE TABLE. ELSE, NORMAL INT
                                    if($post["fRef"][$i] != ""){
                                        //USES THE FIRST 3 CARACTERS OF THIS TABLE
                                        if (strpos($post["fRef"][$i], "_")) {
                                            $temp = explode("_", $post["fRef"][$i]);
                                            $carcEst = substr($temp[0], 0, 2);
                                            $carcEst .= substr($temp[1], 0, 1);
                                        } else {
                                            $carcEst = substr($post["fRef"][$i], 0, 3);
                                        }

                                        $campoTabela = strtoupper($carcEst)."_".strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                                        
                                        if($post["fRef"][$i][strlen($post["fRef"][$i])-1] == 's' or $post["fRef"][$i][strlen($post["fRef"][$i])-1] == 'S'){
                                            $tabelaRef = substr($post["fRef"][$i], 0, strlen($post["fRef"][$i])-1);
                                        }else{
                                            $tabelaRef = $post["fRef"][$i];
                                        }
                                        
                                        $edicao .=
                                    '
        <div class="item-form">
            <label for="'.$campoTabela.'">'.ucwords(($tabelaRef)).'</label>
            <select id="'.$campoTabela.'" name="'.$campoTabela.'">
                <?php foreach($'.strtolower($post["fRef"][$i]).' as $'.strtolower($carcEst).'){ ?>
                <option value="<?php echo $'.strtolower($carcEst).'["'.$campoTabela.'"] ?>" <?php if($'.strtolower($carcEst).'["'.$campoTabela.'"] == (int)$'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'["'.$campoTabela.'"]) echo "selected"; ?>>
                    <?php echo $'.strtolower($carcEst).'["'.strtoupper($carcEst).'_'.strtoupper($post["fDefault"][$i]).'"] ?></option>
                <?php } ?>
            </select>
        </div>
                                        ';
                                    }else{
                                        $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <input type="text" class="pequeno" value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .=
            '
        </div>
                                        ';
                                    }
                                    
                                    
                                    break;
                                case "DECIMAL":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <input type="text" class="valor" value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo number_format($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"], 2, ",", ".") ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .=
            '
        </div>
                                        ';
                                    break;
                                case "DATE":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <input type="text" class="data pequeno" value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo Controller_Index::aaaammdd_ddmmaaaa($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) .'"]) ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .=
            '
        </div>
                                        ';
                                    break;
                                case "TIME":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <input type="text" class="hora pequeno" value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .=
            '
        </div>
                                        ';
                                    break;
                                case "SET":
                                    $edicao .=
                                    '
        <div class="item-form multiplo">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';
            
            //FOREACH SIZE´S ITEM
            $itemSet = explode(",", $post['fTamanho'][$i]);
            
            foreach($itemSet as $its){
                $edicao .= '
            <input type="radio" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" <?php if ($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] == "'.substr($its, 0, 1).'") echo "checked"; ?> id="'.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).$its.'" value="'.substr($its, 0, 1).'">
            <label for="'.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).$its.'">'.$its.'</label>';
            }

            $edicao .=
            '
        </div>
                                        ';
                                    break;
                                case "IMAGEM":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .='
            <input type="file" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" onchange="return ShowImagePreview(this, 0, \'' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '\');">
        </div>
        
        <!--IF IT IS TO SHOW PREVIEW, TAKE DISPLAY NONE OUT-->
        <div class="item-form" id="div' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Canvas" >
            <!--<label>Preview</label>-->
            <!--PREVIEW DA IMAGEM-->
            <canvas id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Canvas" class="previewcanvas" width="0" height="0"> ></canvas>
            <!--CAMPO HIDDEN TO PUT THE RESIZED IMAGE-->
            <input type="hidden" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Blob" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Blob" />
            <input type="text" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'x1" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'x1" style="display: none;">
            <input type="text" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'y1" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'y1" style="display: none;">
            <input type="text" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'w" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'w" style="width: 50px; display: none;">
            <input type="text" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'h" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'h" style="width: 50px; display: none;">
        </div>

        <?php if($' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . ') echo $' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '; ?>
                                    ';

                                    $idImagem = strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])));
                                    break;
                                case "ARQUIVO":
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .='
            <input type="file" id="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" >
        </div>

        <?php if($' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . ') echo $' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '; ?>
                                    ';

                                    break;
                                case "TIMESTAMP":
                                    //TIMESTAMP DO NOT EDIT
                                    break;
                                default:
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <input type="text" value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

            $edicao .=
            '
        </div>
                                        ';
                                    break;
                            }
                            //END FIELD´S TYPES
                        }
                    }
                }
            }

            $edicao .=
                    '
        <div class="final">
            <button type="submit" id="salvar">Send</button>
            <button type="reset" id="limpa">Clear</button>
            <p class="legenda"><em>*</em> Required Fields.</p>
        </div>
    </form>
</section>';
            
            //IF THERE IF TEXT FIELD, ADD CKFINDER
            if(in_array("TEXT", $post["fTipo"])){
                
                $edicao .= '
                    
<script type="text/javascript" src="<?php echo url::base(); ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo url::base(); ?>js/ckfinder/ckfinder.js"></script>

<script type="text/javascript">// <![CDATA[

// This is a check for the CKEditor class. If not defined, the paths must be checked.

if ( typeof CKEDITOR == "undefined" ){

    document.write(

        "<strong><span style=\'color: #ff0000\'>Error</span>: CKEditor not found</strong>." +

        "This sample assumes that CKEditor (not included with CKFinder) is installed in" +

        "the \'/ckeditor/\' path. If you have it installed in a different place, just edit" +

        "this file, changing the wrong paths in the &lt;head&gt; (line 5) and the \'BasePath\'" +

        "value (line 32)." ) ;

}else{
';
                
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF IT IS TEXT TYPE, ADD
                    if ($post["fTipo"][$i] == "TEXT") {
                        $edicao .= '
    var editor' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . ' = CKEDITOR.replace( "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" );
    CKFinder.setupCKEditor( editor' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . ', "<?php echo url::base()?>js/ckfinder/" ) ;';
                    }
                }
                
                $edicao .= '
}
// ]]>
</script>';
            }
            
            //IF THERE IS IMAGE, ADD THE RESIZE FUNCTION
            if(in_array("IMAGEM", $post["fTipo"])){
                
                $edicao .= '
                    
<!--IMAGE RESIZE-->
<script src="<?php echo url::base() ?>js/jcrop/js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="<?php echo url::base() ?>js/jcrop/css/jquery.Jcrop.css" type="text/css" />
<script>
    var imageLoader = document.getElementById("imageLoader");
    function HandleFileEvent(event, selection, id)
    {
        var img = new Image;
        img.onload = function(event) {
            UpdatePreviewCanvas(event, img, selection, id);
        };
        img.src = event.target.result;
    }

    function ShowImagePreview(object, selection, id)
    {
        //DESTROY JCROP
        if ($("#"+id+"Blob").val() !== "") {
            $("#"+id+"Canvas").data("Jcrop").destroy();
            $("#div"+id+"Canvas").append("<canvas id=\'"+id+"Canvas\' class=\'previewcanvas\' ></canvas>");
        }
                    
        if (typeof object.files === "undefined")
            return;

        var files = object.files;

        if (!(window.File && window.FileReader && window.FileList && window.Blob))
        {
            alert("The File APIs are not fully supported in this browser.");
            return false;
        }

        if (typeof FileReader === "undefined")
        {
            alert("Filereader undefined!");
            return false;
        }

        var file = files[0];

        if (file !== undefined && file != null && !(/image/i).test(file.type))
        {
            alert("File is not an image.");
            return false;
        }

        reader = new FileReader();
        reader.onload = function(event) {
            HandleFileEvent(event, selection, id)
        }
        reader.readAsDataURL(file);
    }

    //CONVERTION
    function dataURItoBlob(dataURI) {
        // convert base64 to raw binary data held in a string
        // doesnt handle URLEncoded DataURIs
        var byteString;
        if (dataURI.split(",")[0].indexOf("base64") >= 0)
            byteString = atob(dataURI.split(",")[1]);
        else
            byteString = unescape(dataURI.split(",")[1]);
        // separate out the mime component
        var mimeString = dataURI.split(",")[0].split(":")[1].split(";")[0];

        // write the bytes of the string to an ArrayBuffer
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        // write the ArrayBuffer to a blob, and youre done
        return new Blob([ab], {type: mimeString});
    }

    function UpdatePreviewCanvas(event, img, selection, id)
    {
        var canvas = document.getElementById(id+"Canvas");
        var context = canvas.getContext("2d");
        var world = new Object();
//        world.width = canvas.offsetWidth;
//        world.height = canvas.offsetHeight;
        world.width = 1000;
        world.height = 1000;

        var WidthDif = img.width - world.width;
        var HeightDif = img.height - world.height;

        var Scale = 0.0;
        if (WidthDif > HeightDif)
        {
            Scale = world.width / img.width;
        }
        else
        {
            Scale = world.height / img.height;
        }
        if (Scale > 1)
            Scale = 1;

        var UseWidth = Math.floor(img.width * Scale);
        var UseHeight = Math.floor(img.height * Scale);
        
        canvas.width = UseWidth;
        canvas.height = UseHeight;

        var x = Math.floor((world.width - UseWidth) / 2);
        var y = Math.floor((world.height - UseHeight) / 2);

        context.drawImage(img, 0, 0, img.width, img.height, 0, 0, UseWidth, UseHeight);

        //PUT IT BACK TO INPUT
        if($("#"+id).val().search(".jpg") > 0 || $("#"+id).val().search(".jpeg") > 0 ||
            $("#"+id).val().search(".JPG") > 0 || $("#"+id).val().search(".JPEG") > 0){
            //SECOND PARAM: QUALITY. BROWSER´S DEFAULT: 0.92
            var dataURL = canvas.toDataURL("image/jpeg", 0.92);
        }else if($("#"+id).val().search(".png") > 0 || $("#"+id).val().search(".PNG") > 0){
            var dataURL = canvas.toDataURL("image/png", 0.5);
        }else{
            alert("Type not accepted!");
            $("#"+id).val("");
            return false;
        }

        var blob = dataURItoBlob(dataURL);

        $("#"+id+"Blob").val(dataURL);
        
        //BGCOLOR: BLACK - BLACK BACKGROUND WHEN EDITING
        //BGCOLOR: TRANSPARENT: ALLOW TO SAVE TRANSPARENT PNG
        ';
                
    $max = count($post['fTipo']);
    $maxImagem = 0;
    for ($i = 0; $i < $max; $i++) {
        //IF IT IS IMAGE TYPE, CREATE FUNCTION
        if ($post["fTipo"][$i] == "IMAGEM") {
            if($maxImagem > 0)  $edicao .= 'else';
            
            $edicao .= '
        if(id === "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"){
            var funcao = showCoords' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . ';
        }
        ';
            
            //INCREMENT
            $maxImagem++;
        }
    }
                
                $edicao .= '
        $(canvas).Jcrop({
            bgColor: "transparent",
            bgOpacity: 0.7,
            onSelect: funcao
        });
    }';
    
    $max = count($post['fTipo']);
    for ($i = 0; $i < $max; $i++) {
        //IF IT IS IMAGE TYPE, CREATE FUNCTION
        if ($post["fTipo"][$i] == "IMAGEM") {
            $edicao .= '
    function showCoords' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '(c) {
        // variables can be accessed here as
        // c.x, c.y, c.x2, c.y2, c.w, c.h
        $("#' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'x1").val(c.x);
        $("#' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'y1").val(c.y);
        $("#' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'w").val(c.w);
        $("#' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'h").val(c.h);
    }';
        }
    }
    
    $edicao .= '
</script>';
            }

            //SAVING
            $file = fopen($filename, "w+");
            fwrite($file, stripslashes($edicao));
            fclose($file);


            //LIST FILE
            // PATH TO THE FILE
            $filename = "upload/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/list.php";

//START LIST
            $listagem = '<section id="lista">
    <h1>' . (str_replace("_", " ", $post['fTabela'])) . '</h1>
    
    <!--MESSAGE-->
    <?php if($mensagem != ""){ ?>
    <p><?php echo $mensagem ?></p>
    <?php } ?>
    
    <!--INCLUDE AND SEARCH-->
    <div class="operacoes">
        <a href="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/edit" class="btn-inserir">Insert</a>

        <form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/pesquisa" class="pesquisa">
            <label for="chave">Type something:</label>
            <input type="search" id="chave" name="chave" placeholder="Busca" />
            <button type="submit">Search</button>
        </form>
    </div>
    
    <!--DATA LIST-->
    <table class="padrao">
        <colgroup>
            <col class="box">
            <col class="codigo direita">';
            $cont = 3;

            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S") {
                            $cont++;
                            $listagem .= '
            <col>';
                        }
                    }
                }
            }

            $listagem .= '
            <col class="acoes">
        </colgroup>
        <thead>
            <tr>
                <th><input type="checkbox" class="seleciona" onclick="selecionar(this.checked)" valor="0"></th>
                <th class="codigo direita">Código</th>';
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S") {
                            $listagem .= '
                <th>' . ucwords(($post['fCampo'][$i])) . '</th>';
                        }
                    }
                }
            }
            $listagem .= '
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //IF HAS DATA, SHOW IT. ELSE, SHOW THE WARNING
            if (count($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') > 0) {
                foreach($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' as $' . strtolower($carc) . '){
                    ?>
                    <tr>
                        <td><input type="checkbox" class="seleciona" valor="<?php echo $' . strtolower($carc) . '["' . $carc . '_'.$id[0].'"]; ?>"></td>
                        <td class="codigo direita"><?php echo $' . strtolower($carc) . '["' . $carc . '_'.$id[0].'"]; ?></td>';
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S") {
                            $listagem .= '
                        <td><?php echo $' . strtolower($carc) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"]; ?></td>';
                        }
                    }
                }
            }
            $listagem .= '
                        <td>
                            <a href="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/edit/<?php echo $' . strtolower($carc) . '["' . $carc . '_'.$id[0].'"]; ?>" 
                                class="btn-editar"></a>
                            <a onclick="
                                if (window.confirm(\'Do you really want to delete this data?\')) {
                                    location.href = \'<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/excluir/<?php echo 
                                        $' . strtolower($carc) . '["' . $carc . '_'.$id[0].'"]; ?>\';
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
                    <td colspan="' . $cont . '" class="naoEncontrado">';
            if (strtolower($tabela[strlen($tabela) - 1]) == "a") {
                $listagem .= 'No ';
            } else {
                $listagem .= 'No ';
            }
            $listagem .= ucwords(strtolower(str_replace("_", " ", $post['fTabela'])));
            if (strtolower($tabela[strlen($tabela) - 1]) == "a") {
                $listagem .= ' found';
            } else {
                $listagem .= ' found';
            }
            $listagem .= '</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    
    <!--DELETE ALL CHECKED-->
    <div class="operacoes">
        <a onclick="
            if (window.confirm(\'Do you really want to delete all checked data?\')) {
                excluirTodos(\'<?php echo Request::current()->controller(); ?>\');
            }
           " class="btn-excluir-todos">Delete all checked</a>
    </div>

    <!--PAGINATION-->
    <?php echo $pagination; ?>
</section>

<!--FORM TO DELETE ALL CHECKED-->
<div id="formExc"></div>
';

            //SAVING
            $file = fopen($filename, "w+");
            fwrite($file, stripslashes($listagem));
            fclose($file);

            echo json_encode(array("ok" => "OK"));
        }
    }

}

// End gerar
