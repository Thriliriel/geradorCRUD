<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @package    Kohana/Gerador
 * @category   Base
 * @author     Paulo Knob
 * @copyright  (c) 2014 Paulo Knob
 */
class Kohana_Gerador {

    // Merged configuration settings
    /*
     * view -> default view
     * urlForm -> Form´s action. It´s the path where you will post the fields to generate the new module
     * urlUpload -> Path to generate the module´s files. IMPORTANT: This path need to have write permission.
     */
    protected $config = array(
        'view' => 'gerador/basic',
        'urlForm' => 'gerador/classes/kohana/gerador/salvar',
        'urlUpload' => 'upload/'
    );

    /**
     * Creates a new Gerador object.
     *
     * @param   array  configuration
     * @return  Gerador
     */
    public static function factory(array $config = array()) {
        return new Gerador($config);
    }

    /**
     * Creates a new Gerador object.
     *
     * @param   array  configuration
     * @return  void
     */
    public function __construct(array $config = array()) {
        //DELETE OLD FOLDERS
        $aDirectories = glob($this->config["urlUpload"]."*", GLOB_ONLYDIR);
        $data_venc = date("Y/m/d", time() - (2 * 86400));
        $i = 0;
        $aContent = false;

        foreach ($aDirectories as $sDirectory) {
            $sModified = date("Y/m/d H:i:s", filectime($sDirectory));
            $aContent[$i][$sModified] = $sDirectory;
            $i++;
        }
        
        if($aContent){
            foreach ($aContent as $aCon) {
                foreach ($aCon as $sModified => $sDirectory) {
                    $dataOnly = explode(" ", $sModified);
                    if ($dataOnly[0] <= $data_venc) {

                        //TAKE MODULE
                        $modulo = explode("/", $sDirectory);
                        $modulo = $modulo[1];

                        array_map('unlink', glob($sDirectory . "/controller/*.php"));
                        array_map('unlink', glob($sDirectory . "/view/" . $modulo . "/*.php"));
                        array_map('unlink', glob($sDirectory . "/messages/" . $modulo . ".php"));
                        array_map('unlink', glob($sDirectory . "/model/" . $modulo . ".php"));

                        if (is_dir($sDirectory . "/controller")) {
                            rmdir($sDirectory . "/controller");
                        }

                        if (is_dir($sDirectory . "/view/" . $modulo)) {
                            rmdir($sDirectory . "/view/" . $modulo);
                        }

                        if (is_dir($sDirectory . "/view")) {
                            rmdir($sDirectory . "/view");
                        }

                        if (is_dir($sDirectory . "/messages")) {
                            rmdir($sDirectory . "/messages");
                        }

                        if (is_dir($sDirectory . "/model")) {
                            rmdir($sDirectory . "/model");
                        }

                        if (is_dir($sDirectory)) {
                            rmdir($sDirectory);
                        }
                    }
                }
            }
        }
        
        // Gerador setup
        $this->setup($config);
    }

    /**
     * Loads configuration settings into the object.
     *
     * @param   array   configuration
     * @return  object  Gerador
     */
    public function setup(array $config = array()) {
        
        // Overwrite the current config settings
        $this->config = $config + $this->config;

        // Chainable method
        return $this;
    }
    
    /**
     * Renders the gerador view.
     *
     * @param   mixed   string of the view to use, or a Kohana_View object
     * @return  string  gerador output (HTML)
     */
    public function render($view = NULL) {
        if ($view === NULL) {
            // Use the view from config
            $view = $this->config['view'];
        }

        if (!$view instanceof View) {
            // Load the view file
            $view = View::factory($view);
        }
        
        //Throws the config to View
        $view->config = $this->config;

        // Pass on the whole Gerador object
        return $view->set(get_object_vars($this))->set('page', $this)->render();
    }
    
    /**
     * Renders the gerador links.
     *
     * @return  string  gerador output (HTML)
     */
    public function __toString() {
        try {
            return $this->render();
        } catch (Exception $e) {
            Kohana_Exception::handler($e);
            return '';
        }
    }
    
    //Generate new Module
    public function salvar($post) {

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
            if (!is_dir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))))) {
                mkdir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))), 0777);
                mkdir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/controller", 0777);
                mkdir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/model", 0777);
                mkdir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/messages", 0777);
                mkdir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view", 0777);
                mkdir($this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))), 0777);
            }

//GENERATE TABLE
            $geraTabela = 'Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS ' . str_replace(" ", "_", $tabela) . ' (
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
                                }else if (strpos($post["fRef"][$i], " ")) {
                                    $temp = explode(" ", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                }
                                
                                $campoTabela = strtoupper($carcEst)."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                                
                                //ADD TO VAR TO USE THIS CONSTRAINT IN THE END
                                $foreign .= ',
            FOREIGN KEY ('.$campoTabela.') REFERENCES '.str_replace(" ", "_", strtoupper($this->trataTxt($post["fRef"][$i]))).'('.$campoTabela.') ON DELETE CASCADE ON UPDATE CASCADE';
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
                                
            $geraTabela .= $campoTabela . ' ' . $post['fTipo'][$i] . ' ' . $tam . ' unsigned NOT NULL'.$auto.',
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
            $geraTabela .=  $campoTabela. ' VARCHAR ' . $tam . $unsig.' NOT NULL' . $def . ',
            ';
                                }else{
            $geraTabela .=  $campoTabela. ' ' . $post['fTipo'][$i] . ' ' . $tam . $unsig.' NOT NULL' . $def . ',
            ';
                                }
                                
            
                            }
                        }
                    }
                }
            }

            $geraTabela .= 'PRIMARY KEY  (' . $primary . ')'.$foreign.'
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");';
            
            //GENERATES MESSAGE
            // FILE´S FOLDER
            $filename = $this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/messages/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ".php";
            
//NEW TEXT
            $message = '<?php

//These corespond to the fields that we are invalidating in our model and the error message that will be displayed on our form
return array(';
            
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF IT IS IMAGE OR FILE TYPE, OR PRIMARY KEY, OR TIMESTAMP, AND IT IS REQUIRED
                        if ($post["fTipo"][$i] != "IMAGEM" and $post["fTipo"][$i] != "ARQUIVO" and $post["fTipo"][$i] != "TIMESTAMP"
                                and $post["fPrimaria"][$i] != "S" and $post["fReq"][$i] == "S") {

                            //IF IT IS FOREIGN KEY, ADD THE PREFIX AND THE EXISTS MESSAGE
                            if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                                if (strpos($post["fRef"][$i], "_")) {
                                    $temp = explode("_", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                }else if (strpos($post["fRef"][$i], " ")) {
                                    $temp = explode(" ", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                }
                                
                                $campoTabela = strtoupper($carcEst)."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                                
                                $message .= '
    "'.$campoTabela.'" => array(
        "not_empty" => "'.$post['fRef'][$i].' cannot be empty.",
        "exists'.ucwords(strtolower($carcEst)).'" => "This '.$post['fRef'][$i].' do not exist."
    ),';
                            }else if($post["fTipo"][$i] == "SET"){
                                
                                $funcao = 'valor';
                                $tamanhos = explode(",", $post["fTamanho"][$i]);
                                foreach($tamanhos as $tamanho){
                                    $funcao .= strtoupper($tamanho[0]);
                                }
                                
                                //IF IT IS SET, ADD THE POSSIBILITIES VERIFIER
                                $message .= '
    "'.$carc.'_'.strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
        "not_empty" => "'.$post['fCampo'][$i].' cannot be empty.",
        "'.$funcao.'" => "'.$post['fCampo'][$i].': Invalid value."
    ),';
                            }else{
                                //ADD THE BASIC
                                $message .= '
    "'.$carc.'_'.strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
        "not_empty" => "'.$post['fCampo'][$i].' cannot be empty.",';
                                
                                //IF IT IS STRING OR PASSOWORD, ADD THE SIZE LIMIT
                                if($post["fTipo"][$i] == "VARCHAR" or $post["fTipo"][$i] == "PASSWORD"){
                                
                                $message .= '
        "min_length" => "'.$post['fCampo'][$i].' must have at least 3 caracteres.",
        "max_length" => "'.$post['fCampo'][$i].' must have max '.$post["fTamanho"][$i].' caracteres."';
                                }
                                
                                $message .= '
    ),';
                            }
                        }
                    }
                }
            }
            
            $message .= '
);
?>                
';

            //SAVING
            $file = fopen($filename, "w+");
            fwrite($file, stripslashes($message));
            fclose($file);
            
            //GENERATES MODEL
            // FILE´S FOLDER
            $filename = $this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/model/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ".php";
            
//NEW TEXT
            $model = '<?php

defined("SYSPATH") OR die("No Direct Script Access");

Class Model_' . ucwords(strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela'])))) . ' extends ORM {

    protected $_table_name = "' . str_replace(" ", "_", $tabela) . '";
    protected $_primary_key = "' . $carc . '_'.$id[0].'";
    protected $_sorting = array("' . $carc . '_'.$id[0].'" => "asc");';
    
        //IF THERE IS FOREIGN KEY OR HAS, ADD THE RELATIONSHIP
        if (array_key_exists('fRef', $post) or array_key_exists('fHas', $post)) {
            
            $model .= '
    
    //RELATIONSHIP';
            
            //IF THERE IS FOREIGN KEY, ADD THE BELONGS_TO
            if (is_array($post['fRef'])) {
                
                $model .= '
    protected $_belongs_to = array(';
                
                $max = count($post['fRef']);
                for ($i = 0; $i < $max; $i++) {
                    if ($post['fRef'][$i] != "" and $post['fTipo'][$i] == "INT") {
                        //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                        if (strpos($post["fRef"][$i], "_")) {
                            $temp = explode("_", $post["fRef"][$i]);
                            $carcEst = substr($temp[0], 0, 2);
                            $carcEst .= substr($temp[1], 0, 1);
                            $sep = "_";
                        }else if (strpos($post["fRef"][$i], " ")) {
                            $temp = explode(" ", $post["fRef"][$i]);
                            $carcEst = substr($temp[0], 0, 2);
                            $carcEst .= substr($temp[1], 0, 1);
                            $sep = " ";
                        } else {
                            $carcEst = substr($post["fRef"][$i], 0, 3);
                            $sep = " ";
                        }
                        $carcEst = strtoupper($this->trataTxt($carcEst));
                                
                        $model .= '
        "'.strtolower(str_replace($sep, "", $this->trataTxt($post['fRef'][$i]))).'" => array(
            "model"       => "'.strtolower(str_replace($sep, "", $this->trataTxt($post['fRef'][$i]))).'",
            "foreign_key" => "'.$carcEst.'_ID",
        ),';
                    }
                }
                
                $model .= '
    );';
            }
            
            //IF THERE IS HAS, ADD THE HAS_MANY
            if (is_array($post['fHas'])) {
                
                $model .= '
    protected $_has_many = array(';
                
                $max = count($post['fHas']);
                for ($i = 0; $i < $max; $i++) {
                    if ($post['fHas'][$i] != "") {
                        
                        //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                        if (strpos($post["fHas"][$i], "_")) {
                            $temp = explode("_", $post["fHas"][$i]);
                            $carcEst = substr($temp[0], 0, 2);
                            $carcEst .= substr($temp[1], 0, 1);
                            $sep = "_";
                        }else if (strpos($post["fHas"][$i], " ")) {
                            $temp = explode(" ", $post["fHas"][$i]);
                            $carcEst = substr($temp[0], 0, 2);
                            $carcEst .= substr($temp[1], 0, 1);
                            $sep = " ";
                        } else {
                            $carcEst = substr($post["fHas"][$i], 0, 3);
                            $sep = " ";
                        }
                        $carcEst = strtoupper($this->trataTxt($carcEst));
                        
                        $model .= '
        "'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).'" => array(
            "model"       => "'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).'",
            "foreign_key" => "'.$carc.'_ID",
        ),';
                    }
                }
                
                $model .= '
    );';
            }
            
        }
            
            $model .= '
                
    //VALIDATION RULES
    //Define all validations our model must pass before being saved
    //Notice how the errors defined here correspond to the errors defined in our Messages file
    public function rules() {
        return array(';
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        //IF IT IS IMAGE OR FILE TYPE, OR PRIMARY KEY, OR TIMESTAMP, AND IT IS REQUIRED
                        if ($post["fTipo"][$i] != "IMAGEM" and $post["fTipo"][$i] != "ARQUIVO" and $post["fTipo"][$i] != "TIMESTAMP" 
                                and $post["fPrimaria"][$i] != "S" and $post["fReq"][$i] == "S") {
                            //IF IT IS FOREIGN KEY, TAKE THE PREFIX
                            if($post["fRef"][$i] != "" and $post["fTipo"][$i] == "INT"){
                                //TAKE THE 3 FIRST CARACTERES OF THIS TABLE
                                if (strpos($post["fRef"][$i], "_")) {
                                    $temp = explode("_", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                }else if (strpos($post["fRef"][$i], " ")) {
                                    $temp = explode(" ", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                }
                                $carcEst = strtoupper($this->trataTxt($carcEst));
                                
            $model .= '
            "'.$carcEst."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
                array("not_empty"),
                array(array($this, "exists'.ucwords(strtolower($carcEst)).'")),';
            
            $model .= '
            ),';
                                
                            }else{
            $model .= '
            "'.$carc."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
                array("not_empty"),';
            
                            //IF IT IS SET TYPE, ADD THE VALIDATION FUNCTION
                            if (($post["fTipo"][$i] == 'SET')) {
                                $funcao = 'valor';
                                $tamanhos = explode(",", $post["fTamanho"][$i]);
                                foreach($tamanhos as $tamanho){
                                    $funcao .= strtoupper($tamanho[0]);
                                }
                                
            $model .= '
                array(array($this, "'.$funcao.'")),';
                            }
                            
                            //IF IT IS STRING OR PASSWORD, ADD MIN AND MAX
                            if (($post["fTamanho"][$i] > 0) and ($post["fTipo"][$i] == 'VARCHAR' or $post["fTipo"][$i] == 'PASSWORD')) {
            $model .= '
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", '.$post["fTamanho"][$i].')),';
                            }
                            
                $model .= '
            ),';   
                            }
                        }
                    }
                }
            }
            
            $model .= '
        );
    }
    
    //FILTERS
    public function filters(){
        return array(';
        if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post["fTipo"][$i] == "DATE") {
            $model .= '
            "'.$carc."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
                array(array($this, "arrumaData")),
            ),';
                        }
        
                        if ($post["fTipo"][$i] == "DECIMAL") {
            $model .= '
            "'.$carc."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
                array(array($this, "arrumaValor")),
            ),';
                        }
                        
                        if ($post["fTipo"][$i] == "PASSWORD") {
            $model .= '
            "'.$carc."_".strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'" => array(
                array(array($this, "criptografaSenha")),
            ),';
                        }
                    }
                }
        }
            
            $model .= '
        );
    }

    public function __construct($id = NULL) {
        //GENERATE THE TABLE
        '.$geraTabela.'
        
        parent::__construct($id);
    }';
            
    //IF THERE IS FOREIGN KEY, ADD THE RELATIONSHIP VALIDATION
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
                    }else if (strpos($post["fRef"][$i], " ")) {
                        $temp = explode(" ", $post["fRef"][$i]);
                        $carcEst = substr($temp[0], 0, 2);
                        $carcEst .= substr($temp[1], 0, 1);
                    } else {
                        $carcEst = substr($post["fRef"][$i], 0, 3);
                    }
                    $carcEst = strtoupper($this->trataTxt($carcEst));

                    $model .= '
                        
    //CHECK IF '.strtoupper($this->trataTxt($post['fRef'][$i])).' EXISTS
    public static function exists'.ucwords(strtolower($carcEst)).'($id) {
        $results = DB::select("*")->from("'.strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fRef'][$i])))).'")->where("'.$carcEst.'_'.strtoupper(str_replace(" ", "_", str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).'", "=", $id)->execute()->as_array();
        if(count($results) == 0)
            return false;
        else
            return true;
    }';
                }
            }
        }
            
    }
    
    //IF THERE IS SET TYPE, ADD THE VALIDATION FUNCTION
    if (array_key_exists('fCampo', $post)) {
        if (is_array($post['fCampo'])) {
            $max = count($post['fCampo']);
            for ($i = 0; $i < $max; $i++) {
                //IF IT IS SET TYPE AND IS NOT THE DEFAULT ONE (YES OR NO), ADD
                if ($post["fTipo"][$i] == "SET" and $post["fTamanho"][$i] != "Yes,No") {
                    
                    $tamanhos = explode(',', $post["fTamanho"][$i]);
                    
                    //VALUES TO FILL THE FUNCTION
                    $valores1 = "";
                    $valores2 = "";
                    $valores3 = "";
                    $valores4 = "valor";
                    $flag = 0;
                    
                    foreach($tamanhos as $tamanho){
                        if($flag > 0){
                            $valores1 .= " OR ";
                            $valores2 .= " OR ";
                            $valores3 .= " and ";
                        }
                        
                        $valores1 .= '"'.strtoupper($tamanho[0]).'"';
                        $valores2 .= $tamanho;
                        $valores3 .= '$valor != "'.strtoupper($tamanho[0]).'"';
                        $valores4 .= strtoupper($tamanho[0]);
                        
                        $flag++;
                    }
                    
                    $model .= '
    
    //VALIDATE THE VALUES '.$valores1.' (TO VALOR '.$valores2.')
    public function '.$valores4.'($valor) {
        //CHECKS IF VALOR IS VALID
        if('.$valores3.'){
            return false;
        }else    return true;
    }';
                    
                }
            }
        }
    }
            
    //CLOSE THE MODEL
            $model .= '
}
';

            //SAVING
            $file = fopen($filename, "w+");
            fwrite($file, stripslashes($model));
            fclose($file);
            
            //GENERATES THE CONTROLLER
            // FILE´S FOLDER
            $filename = $this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/controller/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ".php";

//New Text
            $controlador = '<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_' . ucwords(strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela'])))) . ' extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - ' . ucwords(strtolower($post['fTabela'])) . '";
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCE THE LIST VIEW AS DEFAULT
        $view = View::Factory("' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/list");
        
        //INSTANCE THE ORM     
        $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = ORM::factory("' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '")';
            
        //IF THERE IS FOREIGN KEY, ADD IT
        if (array_key_exists('fRef', $post)) {
            if (is_array($post['fRef'])) {
                $max = count($post['fRef']);
                for ($i = 0; $i < $max; $i++) {
                    if ($post['fRef'][$i] != "" and $post['fTipo'][$i] == "INT") {
                        //FIND THE SEPARATOR
                        if (strpos($post["fRef"][$i], "_")) {
                            $sep = "_";
                        }else if (strpos($post["fRef"][$i], " ")) {
                            $sep = " ";
                        } else {
                            $sep = " ";
                        }
                        
                        $controlador .= '->with("'.strtolower(str_replace($sep, "", $this->trataTxt($post['fRef'][$i]))).'")';
                    }
                }
            }
        }
            
            $controlador .= ';';
        
            $busca = '"'.$carc . '_' . $id[0] . '"=>"'.$carc . '_' . $id[0] . '"';
            $itemPesquisa = '';
            //FILL THE SEARCH WITH THE MARKED FIELDS
            if (array_key_exists('fPesquisar', $post)) {
                if (is_array($post['fPesquisar'])) {
                    $max = count($post['fPesquisar']);
                    $j = 0;
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S") {
                            
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
                                
                                if($j == 0){
                                    $itemPesquisa .= '->where("'.$carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'", "like", "%".$this->sane('.$valorCampo.')."%")';
                                }else{
                                    $itemPesquisa .= '->or_where("'.$carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'", "like", "%".$this->sane('.$valorCampo.')."%")';
                                }
                                
                                $j++;
                            }
                            
                            $busca .= ', "'.$carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"=>"'.$carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"';
                        }
                    }
                }
            }
            
            $controlador .= '
                
        //SETS THE RIGHT COLUMNS TO SEARCH
        $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '->setColumns(array('.$busca.'));
        
        //CHECK IF THERE IS SOME SEARCH
        if(isset($_GET["chave"])){
            $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . $itemPesquisa.';
        }
        
        //PAGINATION
        $paginas = $this->action_page($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ', $this->qtdPagina);
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
                        }else if (strpos($post["fRef"][$i], " ")) {
                            $temp = explode(" ", $post["fRef"][$i]);
                            $carcEst = substr($temp[0], 0, 2);
                            $carcEst .= substr($temp[1], 0, 1);
                        } else {
                            $carcEst = substr($post["fRef"][$i], 0, 3);
                        }
                                
                        $controlador .= '
        //BRING '.str_replace("_", " ", strtoupper($this->trataTxt($post['fRef'][$i]))).'
        $view->'.str_replace(" ", "", strtolower($this->trataTxt($post['fRef'][$i]))).' = ORM::factory("'.str_replace(" ", "", strtolower($this->trataTxt($post['fRef'][$i]))).'")->find_all();
                            ';
                    }
                }
            }
        }
            
        $controlador .= '
        //IF THE ID EXISTS, BRING THE DATA
        if($id){
            //BRING THE DATA AND FILL THE FIELDS
            $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = ORM::factory("' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '");
            $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ' = $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '->where($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '->primary_key(), "=", $this->sane($id))->find();
            ';

            $controlador .= '
            $arr = array(';

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
                                } else if (strpos($post["fRef"][$i], " ")) {
                                    $temp = explode(" ", $post["fRef"][$i]);
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
                "' . $campoTabela . '" => $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '->' . $campoTabela . ',';
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
            $'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'thumb_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '->'.$carc.'_'.$id[0].' . ".*");
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
            $'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).' = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '->'.$carc.'_'.$id[0].' . ".*");
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
                                }else if (strpos($post["fRef"][$i], " ")) {
                                    $temp = explode(" ", $post["fRef"][$i]);
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

        //MESSAGE WITH OK OR ERROR
        $mensagem = "Data changed!";
';
            //IF THERE IS IMAGE, ADD EXCLUIRIMAGEM AS FALSE
            if(in_array("IMAGEM", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF TYPE IS IMAGE, ADD
                    if ($post["fTipo"][$i] == "IMAGEM") {
                        $controlador .= '
        $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' = false;
                ';
                    }
                }
            }
            
            //IF THERE IS FILE, ADD EXCLUIRFILE AS FALSE
            if(in_array("ARQUIVO", $post["fTipo"])){
                $max = count($post['fTipo']);
                for ($i = 0; $i < $max; $i++) {
                    //IF TYPE IS FILE, ADD
                    if ($post["fTipo"][$i] == "ARQUIVO") {
                        $controlador .= '
        $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i])))).' = false;
                ';
                    }
                }
            }

            $controlador .=
                    '
        //IF ID IS EMPTY, INSERT
        if($this->request->post("' . $carc . '_'.$id[0].'") == "0" ){ 
            
            $'.strtolower(str_replace(" ", "", $this->trataTxt($post['fTabela']))).' = ORM::factory("'.strtolower(str_replace(" ", "", $this->trataTxt($post['fTabela']))).'");';
            
            $controlador .= '
            
            //INSERT
            foreach($this->request->post() as $campo => $value){';
            
            //CHECK IF EXISTS PASSWORD, TO IGNORE THE CONFIRMATION
            if(in_array("PASSWORD", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                $controlador .= '
                if(';
                
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
                            if ($tipo == "PASSWORD") {
                                $default .= '
                '.
                $flag.' ($campo == "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '") {
                //CHECK EMPTY PASSWORD, DO NOT SAVE SO
                if ($value == "") {
                    continue;
                }
                else {
                    if ($value == $this->request->post("' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C"))
                        $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->$campo = $value;
                }
            }';
                                $flag = "else if";
                                $qntCampos++;
                            } else if ($tipo == "IMAGEM") {
                                $default .= '
                '.
            $flag . ' ($campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Blob" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'x1" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'y1" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'w" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'h") {
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
                    $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->$campo = $value;
                }';
                    } else {
                        $default .= '
                $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->$campo = $value;';
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
            
            //TRY TO SAVE. IF IT DO NOT PASS THE MODEL VALIDATION, CATCH IT
            try{
                $query = $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->save();
                $mensagem = "Data inserted!";';
            
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
                    $imgName = "'.$extraImagem.'".$'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . ".".$ext;
                    file_put_contents(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName, $data);

                    //CROP
                    if($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") != "" and $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") > 0){
                        $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                        $img = $img->crop($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'h"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'x1"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'y1"))->save(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                    }

                    //THUMB
                    $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                    $imgName = "'.$extraImagem.'thumb_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . ".".$ext;
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
                    $arqName = "'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_".$'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . "." . $ext[count($ext) - 1];

                    if($ext[count($ext) - 1] == "doc" or $ext[count($ext) - 1] == "docx" or $ext[count($ext) - 1] == "pdf"){
                        copy($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["tmp_name"], DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$arqName);
                    }
                }';
                    }
                }
            }
            
            $controlador .= '
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $mensagem = $e->errors("models");
            }';
            
        $controlador .= '
        }else{
            //ELSE, UPDATE
            $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).' = ORM::factory("'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'", $this->request->post("'.$carc.'_'.$id[0].'"));
            
            //IF THE MODULE IS LOADED, UPDATE. ELSE, DO NOTHING
            if ($'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->loaded()){
                //UPDATE
                foreach($this->request->post() as $campo => $value){';
                
        //CHECK IF EXISTS PASSWORD, TO IGNORE THE CONFIRMATION
            if(in_array("PASSWORD", $post["fTipo"])){
                $max = count($post['fTipo']);
                
                    $controlador .= '
                    if(';
                
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
                            if ($tipo == "PASSWORD") {
                                $default .= '
                    '.
                    $flag.' ($campo == "' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '") {
                    //CHECK EMPTY PASSWORD, DO NOT SAVE SO
                    if ($value == "") {
                        continue;
                    }
                    else {
                        if ($value == $this->request->post("' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C"))
                            $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->$campo = $value;
                    }
                }';
                                $flag = "else if";
                                $qntCampos++;
                            } else if ($tipo == "IMAGEM") {
                                $default .= '
                    '.
                    $flag . ' ($campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'Blob" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'x1" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'y1" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'w" or $campo == "' . strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . 'h") {
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
                        $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->$campo = $value;
                    }';
                    } else {
                        $default .= '
                    $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->$campo = $value;';
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
                
                //TRY TO SAVE. IF IT DO NOT PASS THE MODEL VALIDATION, CATCH IT
                try{
                    $query = $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->save();';
            
            //IF THERE IS IMAGE, ADD IT
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
                        $imgsT = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'thumb_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . ".*");
                        $imgs = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.$extraImagem.'" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . ".*");

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
                        $imgName = "'.$extraImagem.'".$'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . ".".$ext;
                        file_put_contents(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName, $data);

                        //CROP
                        if($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") != "" and $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w") > 0){
                            $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                            $img = $img->crop($this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'w"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'h"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'x1"), $this->request->post("'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'y1"))->save(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                        }

                        //THUMB
                        $img = Image::factory(DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$imgName);
                        $imgName = "'.$extraImagem.'thumb_" . $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk() . ".".$ext;
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
                        $arq = glob("upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_" . str_replace("\'", "", $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk()) . ".*");

                        if($arq){
                            foreach($arq as $ar){
                                unlink($ar);
                            }
                        }
                    }

                    //INSERT '.strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).', IF ANY
                    if ($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"] != "") {

                        $ext = explode(".", $_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"]);
                        $arqName = "'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'_".str_replace("\'", "", $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->pk()) . "." . $ext[count($ext) - 1];

                        if($ext[count($ext) - 1] == "doc" or $ext[count($ext) - 1] == "docx" or $ext[count($ext) - 1] == "pdf"){
                            copy($_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["tmp_name"], DOCROOT."upload/'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'/".$arqName);
                        }
                    }';
                        
                        //ADD THE FILE ITENS TO CHECK ON THE IF(QUERY)
                        $queryExtra .= ' or $_FILES["'.strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))).'"]["name"] != "" or $exclui'.ucwords(strtolower(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))));
                    }
                }
            }
            
            $controlador .= '
                } catch (ORM_Validation_Exception $e){
                    $query = false;
                    $mensagem = $e->errors("models");
                }
            } else{
                $query = false;
                $mensagem = "There was some problem, no changes made!";
            }';
            
            $controlador .= '
        }
        
        //IF MESSAGE IS AN ARRAY, CHANGE TO STRING
        if(is_array($mensagem)){
            $men = "";
            foreach($mensagem as $m){
                $men .= $m."<br>";
            }
            $mensagem = $men;
        }
        
        //IF IT WORKED, COME BACK TO LIST WITH OK MESSAGE
        if($query'.$queryExtra.'){
            $this->action_index($mensagem, false);
        }else{
            //ELSE, COME BACK WITH THE ERROR MESSAGE
            $this->action_index($mensagem, true);
        }
    }
    
    //DELETE DATA
    public function action_excluir(){';
            
            $existe = false;
            
            //IF THERE IS HAS, ADD THE SEARCH BEFORE DELETE
            if (array_key_exists('fHas', $post)) {
                if (is_array($post['fHas'])) {
                    $max = count($post['fHas']);
                    
                    //ADD THE ORM
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fHas'][$i] != "") {
                            $existe = true;
                            
                            //TAKE THE 3 FIRST CARACTERS OF THIS TABLE
                            if (strpos($post["fHas"][$i], "_")) {
                                $temp = explode("_", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = "_";
                            }else if (strpos($post["fHas"][$i], " ")) {
                                $temp = explode(" ", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = " ";
                            } else {
                                $carcEst = substr($post["fHas"][$i], 0, 3);
                                $sep = " ";
                            }
                            $carcEst = strtoupper($this->trataTxt($carcEst));

                            $controlador .= '
        //CHECK IF EXISTS '.strtoupper(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).' ON THIS '.strtoupper($this->trataTxt($post['fTabela'])).'. IF SO, DO NOT LET DELETE
        $'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).' = ORM::factory("'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).'")->where("'.$carc.'_ID", "=", $this->request->param("id"))->count_all();';
                        }
                    }
                    
                    if($existe){
                    $controlador .= '
                        
        if (';
                    $apelao = '';
                    $itens = '';
                    
                    //ADD THE CONDITION
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fHas'][$i] != "") {
                            //TAKE THE 3 FIRST CARACTERS OF THIS TABLE
                            if (strpos($post["fHas"][$i], "_")) {
                                $temp = explode("_", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = "_";
                            }else if (strpos($post["fHas"][$i], " ")) {
                                $temp = explode(" ", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = " ";
                            } else {
                                $carcEst = substr($post["fHas"][$i], 0, 3);
                                $sep = " ";
                            }
                            $carcEst = strtoupper($this->trataTxt($carcEst));

                            $controlador .= $apelao.'$'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).' > 0';
                            
                            //ADD ITENS
                            if($apelao != ''){
                                $itens .= ', ';
                            }
                            
                            $itens .= $post['fHas'][$i];
                        
                            $apelao = ' or ';
                        }
                    }
                    
                    //CLOSE IF
                    $controlador .= '){
            $this->action_index("There is '.$itens.' on this '.$post['fTabela'].'! No changes made!", true);
        }else{
                        ';
                    }
                }
            }
            
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
        $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).' = ORM::factory("'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'", $this->request->param("id"));
            
        //IF MODULE IS LOADED, DELETE. ELSE, DO NOTHING
        if ($'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->loaded()){
            //DELETE
            $query = $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->delete();
        }else{
            $query = false;
        }
        
        //IF IT WORKED, COME BACK TO LIST WITH OK MESSAGE
        if($query){
            $this->action_index("Data deleted!", false);
        }else{
            //ELSE, COME BACK TO LIST WITH THE ERROR MESSAGE
            $this->action_index("There was some problem!", true);
        }';
            
            //IF THERE IS HAS, CLOSE ELSE
            if ($existe) {
        $controlador .= '
        }';
            }
            
            $controlador .= '
    }
    
    //DELETE ALL CHECKED DATA
    public function action_excluirTodos() {
        $query = false;
        
        foreach ($this->request->post() as $value) {
            foreach($value as $val){';
            
            $existe = false;
            
            //IF THERE IS HAS, ADD THE SEARCH BEFORE DELETE
            if (array_key_exists('fHas', $post)) {
                if (is_array($post['fHas'])) {
                    $max = count($post['fHas']);
                    
                    //ADD ORM
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fHas'][$i] != "") {
                            $existe = true;
                            
                            //TAKE THE 3 FIRST CARACTERS OF THIS TABLE
                            if (strpos($post["fHas"][$i], "_")) {
                                $temp = explode("_", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = "_";
                            }else if (strpos($post["fHas"][$i], " ")) {
                                $temp = explode(" ", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = " ";
                            } else {
                                $carcEst = substr($post["fHas"][$i], 0, 3);
                                $sep = " ";
                            }
                            $carcEst = strtoupper($this->trataTxt($carcEst));

                            $controlador .= '
                //CHECK IF EXISTS '.strtoupper(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).' ON THIS '.strtoupper($this->trataTxt($post['fTabela'])).'. IF SO, DO NOT LET DELETE
                $'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).' = ORM::factory("'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).'")->where("'.$carc.'_ID", "=", $this->request->param("id"))->count_all();';
                        }
                    }
                    
                    if($existe){
                    $controlador .= '
                        
                if (';
                    $apelao = '';
                    $itens = '';
                    
                    //ADD IF WITH ORM
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fHas'][$i] != "") {
                            //TAKE THE 3 FIRST CARACTERS OF THIS TABLE
                            if (strpos($post["fHas"][$i], "_")) {
                                $temp = explode("_", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = "_";
                            }else if (strpos($post["fHas"][$i], " ")) {
                                $temp = explode(" ", $post["fHas"][$i]);
                                $carcEst = substr($temp[0], 0, 2);
                                $carcEst .= substr($temp[1], 0, 1);
                                $sep = " ";
                            } else {
                                $carcEst = substr($post["fHas"][$i], 0, 3);
                                $sep = " ";
                            }
                            $carcEst = strtoupper($this->trataTxt($carcEst));

                            $controlador .= $apelao.'$'.strtolower(str_replace($sep, "", $this->trataTxt($post['fHas'][$i]))).' > 0';
                            
                            //ADD ITENS
                            if($apelao != ''){
                                $itens .= ', ';
                            }
                            
                            $itens .= $post['fHas'][$i];
                        
                            $apelao = ' or ';
                        }
                    }
                    
                    //CLOSE IF
                    $controlador .= '){
                    $this->action_index("There is '.$itens.' on '.$post['fTabela'].'! No changes made!", true);
                    return true;
                }else{
                        ';
                    }
                }
            }
            
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
                $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).' = ORM::factory("'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'", $val);
            
                //IF MODULE IS LOADED, DELETE. ELSE, DO NOTHING
                if ($'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->loaded()){
                    //DELETE
                    $query = $'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'->delete();
                }else{
                    $query = false;
                }';
            
            //IF THERE IS HAS, CLOSE ELSE
            if ($existe) {
                $controlador .= '
                }';
            }
            
            $controlador .= '
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
            $filename = $this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/edit.php";

//START EDIT FORM
            $edicao = '<section id="formulario">
    <h1>' . ucwords(str_replace("_", " ", $post['fTabela'])) . '</h1>
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
            <input type="password" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"
                >';

            $edicao .= '
        </div>
        
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C">Repeat ' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .= '
            <input type="password" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '_C"
                >';

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
                                        }else if (strpos($post["fRef"][$i], " ")) {
                                            $temp = explode(" ", $post["fRef"][$i]);
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
            <select id="'.$campoTabela.'" name="'.$campoTabela.'" >
                <?php foreach($'.str_replace(" ", "", strtolower($this->trataTxt($post["fRef"][$i]))).' as $'.strtolower($carcEst).'){ ?>
                <option value="<?php echo $'.strtolower($carcEst).'->'.$campoTabela.' ?>" <?php if($'.strtolower($carcEst).'->'.$campoTabela.' == (int)$'.strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))).'["'.$campoTabela.'"]) echo "selected"; ?>>
                    <?php echo $'.strtolower($carcEst).'->'.strtoupper($carcEst).'_'.strtoupper($this->trataTxt($post["fDefault"][$i])).' ?></option>
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
            <!--IMAGE PREVIEW-->
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
                                    
                                    $validar = '';
                                    
                                    if($post["fReq"][$i] == "S"){
                                        $validar = 'validar="texto"';
                                    }
                                    
                                    $edicao .=
                                    '
        <div class="item-form">
            <label for="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">' . ucwords(($post['fCampo'][$i])) . '</label>';

            $edicao .=
                    '
            <input type="text" '.$validar.' value="<?php if($' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . ') echo $' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '["' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '"] ?>" id="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '" name="' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '">';

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

            //SALVING
            $file = fopen($filename, "w+");
            fwrite($file, stripslashes($edicao));
            fclose($file);


            //LIST FILE
            // PATH TO THE FILE
            $filename = $this->config["urlUpload"] . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/view/" . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . "/list.php";

//START LIST
            $listagem = '<section id="lista">
    <h1>' . ucwords(str_replace("_", " ", $post['fTabela'])) . '</h1>
    
    <!--MESSAGE-->
    <?php if($mensagem != ""){ ?>
    <p><?php echo $mensagem ?></p>
    <?php } ?>
    
    <!--INCLUDE AND SEARCH-->
    <div class="operacoes">
        <a href="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/edit" class="btn-inserir">Insert</a>

        <form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/pesquisa" class="pesquisa">
            <label for="chave">Type something:</label>
            <input type="search" id="chave" name="chave" placeholder="Key" />
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
                        if ($post['fPesquisar'][$i] == "S" or $post['fRef'][$i] != "") {
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
                <th class="codigo direita">Id</th>';
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S" or $post['fRef'][$i] != "") {
                            if($post['fRef'][$i] != ""){
                                $listagem .= '
                <th>' . ucwords(($post['fRef'][$i])) . '</th>';
                            }else{
                                $listagem .= '
                <th>' . ucwords(($post['fCampo'][$i])) . '</th>';
                            }
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
                        <td><input type="checkbox" class="seleciona" valor="<?php echo $' . strtolower($carc) . '->' . $carc . '_'.$id[0].'; ?>"></td>
                        <td class="codigo direita"><?php echo $' . strtolower($carc) . '->' . $carc . '_'.$id[0].'; ?></td>';
            if (array_key_exists('fCampo', $post)) {
                if (is_array($post['fCampo'])) {
                    $max = count($post['fCampo']);
                    for ($i = 0; $i < $max; $i++) {
                        if ($post['fPesquisar'][$i] == "S" or $post['fRef'][$i] != "") {
                            if($post['fRef'][$i] != ""){
                                //TAKE THE 3 FIRST CARACTERES OF THE TABLE
                                if (strpos($post["fRef"][$i], "_")) {
                                    $temp = explode("_", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                    $sep = "_";
                                }else if (strpos($post["fRef"][$i], " ")) {
                                    $temp = explode(" ", $post["fRef"][$i]);
                                    $carcEst = substr($temp[0], 0, 2);
                                    $carcEst .= substr($temp[1], 0, 1);
                                    $sep = " ";
                                } else {
                                    $carcEst = substr($post["fRef"][$i], 0, 3);
                                    $sep = " ";
                                }
                                $carcEst = strtoupper($carcEst);
                                
                                $listagem .= '
                        <td><?php echo $' . strtolower($carc) . '->'. strtolower(str_replace($sep, "", $this->trataTxt($post['fRef'][$i]))). '->' . $carcEst . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fDefault'][$i]))) . '; ?></td>';
                            }else{
                                $listagem .= '
                        <td><?php echo $' . strtolower($carc) . '->' . $carc . '_' . strtoupper(str_replace(" ", "_", $this->trataTxt($post['fCampo'][$i]))) . '; ?></td>';
                            }
                        }
                    }
                }
            }
            $listagem .= '
                        <td>
                            <a href="<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/edit/<?php echo $' . strtolower($carc) . '->' . $carc . '_'.$id[0].'; ?>" 
                                class="btn-editar"></a>
                            <a onclick="
                                if (window.confirm(\'Do you really want to delete this data?\')) {
                                    location.href = \'<?php echo url::base() ?>' . strtolower(str_replace($separador, "", $this->trataTxt($post['fTabela']))) . '/excluir/<?php echo 
                                        $' . strtolower($carc) . '->' . $carc . '_'.$id[0].'; ?>\';
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
            
            return true;
    }
    
    //Take some caracters out
    protected static function trataTxt($var) {
        //return preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($var));
        $trocarIsso = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ',);
	$porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y',);
	$titletext = str_replace($trocarIsso, $porIsso, $var);
        return $titletext;
    }
}

// End Gerador