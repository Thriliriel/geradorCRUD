<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Teste extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - Teste";
        
        //GENERATES TABLE
        $this->db->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS TESTE (
            TES_ID INT (11) unsigned NOT NULL auto_increment,
            TES_TITULO VARCHAR (50) NOT NULL,
            TES_DATA DATE  NOT NULL,
            PRIMARY KEY  (TES_ID)
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCE THE LIST VIEW AS DEFAULT
        $view = View::Factory("teste/list");
        
        $where = "";
        
        //CHECK IF THERE IS SOME SEARCH
        if(isset($_GET["chave"])){
            $where .= " where TES_TITULO like '%".$_GET["chave"]."%'";
        }
        
        //TAKE THE DATA
        $paginas = $this->action_page("select * from TESTE ".$where." order by TES_ID desc", $this->qtdPagina);
        $view->teste = $paginas["data"];
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
        $view = View::Factory("teste/edit");
        
        $id = $this->request->param("id");
        
        //IF THE ID EXISTS, BRING THE DATA
        if($id){
            //BRING THE DATA AND FILL THE FIELDS
            $teste = $this->db->query(Database::SELECT, "select * from TESTE where TES_ID = ".addslashes($id));
            $arr = array(
                "TES_ID" => $teste[0]["TES_ID"],
                "TES_TITULO" => $teste[0]["TES_TITULO"],
                "TES_DATA" => $teste[0]["TES_DATA"],
            );
            
            $view->teste = $arr;
        }else{
            //ELSE, SET AS EMPTY
            $arr = array( 
                "TES_ID" => "0",
                "TES_TITULO" => "",
                "TES_DATA" => date("Y-m-d"),
            );
            
            $view->teste = $arr;
        }
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }
    
    //SAVE DATA
    public function action_save(){
        //TAKE THE FIELDS
        foreach($this->request->post() as $campo => $value){
            if ($campo == "TES_DATA") {
                $valores[$campo] = ("'" . $this->ddmmaaaa_aaaammdd(addslashes($value)) . "'");
            }else{ 
                $valores[$campo] = ("'".addslashes($value)."'"); 
            }
        }

        //IF ID IS EMPTY, INSERT
        if($valores["TES_ID"] == "'0'" ){            
            //INSERT
            $query = $this->db->query(Database::INSERT, "insert into TESTE(".$this->implode_keys(",", $valores).") 
                values(".implode(",", $valores).")");
        }else{
            //ELSE, UPDATE
            $sql = "";
            //FILL SQL
            foreach($valores as $it => $va){
                $sql .= $it." = ".$va.",";
            }
            //ALTER
            $query = $this->db->query(Database::UPDATE, "update TESTE set ".substr($sql, 0, strlen($sql)-1)." where TES_ID = 
                ".$valores["TES_ID"]);
        }
        
        //IF IT WORKED, COME BACK TO LIST WITH OK MESSAGE
        if($query){
            $this->action_index("Data changed!", false);
        }else{
            //ELSE, COME BACK WITH THE ERROR MESSAGE
            $this->action_index("There was some problem, no changes made!", true);
        }
    }
    
    //DELETE DATA
    public function action_excluir(){
        //DELETE
        $query = $this->db->query(Database::DELETE, "delete from TESTE where TES_ID = ".$this->request->param("id"));
        
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
            foreach($value as $val){
                //DELETE
                $query = $this->db->query(Database::DELETE, "delete from TESTE where TES_ID = " . $val);
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

// End teste
