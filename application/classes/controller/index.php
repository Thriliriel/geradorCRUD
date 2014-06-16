<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {

    public $template = 'template';
    public $gravar_logs = TRUE;
    public $empresa = "Tio";

    public function before() {
        parent::before();

        $this->template->titulo = $this->empresa;

        $this->template->bemvindo = false;

        $this->template->cliente = false;

        //DELETE OLD FOLDERS
        $aDirectories = glob("upload/*", GLOB_ONLYDIR);
        $data_venc = date("Y/m/d", time() - (2 * 86400));
        $i = 0;
        $aContent = array();

        foreach ($aDirectories as $sDirectory) {
            $sModified = date("Y/m/d H:i:s", filectime($sDirectory));
            $aContent[$i][$sModified] = $sDirectory;
            $i++;
        }

        if (count($aContent) > 0) {
            foreach ($aContent as $aCon) {
                foreach ($aCon as $sModified => $sDirectory) {
                    $dataOnly = explode(" ", $sModified);
                    if ($dataOnly[0] <= $data_venc) {

                        //TAKE THE MODULE
                        $modulo = explode("/", $sDirectory);
                        $modulo = $modulo[1];

                        array_map('unlink', glob($sDirectory . "/controller/*.php"));
                        array_map('unlink', glob($sDirectory . "/view/" . $modulo . "/*.php"));

                        if (is_dir($sDirectory . "/controller")) {
                            rmdir($sDirectory . "/controller");
                        }

                        if (is_dir($sDirectory . "/view/" . $modulo)) {
                            rmdir($sDirectory . "/view/" . $modulo);
                        }

                        if (is_dir($sDirectory . "/view")) {
                            rmdir($sDirectory . "/view");
                        }

                        if (is_dir($sDirectory)) {
                            rmdir($sDirectory);
                        }
                    }
                }
            }
        }
    }

    public function action_index() {
        $this->request->redirect("gerar");

        $view = View::Factory('index');

        $this->template->bt_voltar = false;

        $this->template->conteudo = $view;
    }

    public static function aaaammdd_ddmmaaaa($aaaa_mm_dd) {
        $axdia = substr($aaaa_mm_dd, 8, 2);
        $axmes = substr($aaaa_mm_dd, 5, 2);
        $axano = substr($aaaa_mm_dd, 0, 4);
        $dd_mm_aaaa = $axdia . "/" . $axmes . "/" . $axano;
        return $dd_mm_aaaa;
    }

    public static function ddmmaaaa_aaaammdd($dd_mm_aaaa) {
        $axdia = substr($dd_mm_aaaa, 0, 2);
        $axmes = substr($dd_mm_aaaa, 3, 2);
        $axano = substr($dd_mm_aaaa, 6, 4);
        $aaaa_mm_dd = $axano . "-" . $axmes . "-" . $axdia;
        return $aaaa_mm_dd;
    }

    //IMPLODE ARRAY KEYS
    public function implode_keys($separador, $array) {
        $keys = array_keys($array);
        return implode($separador, $keys);
    }

    //TAKE THINGS OUT
    public static function trataTxt($var) {
        //return preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($var));
        $trocarIsso = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', 'Ÿ',);
        $porIsso = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'Y',);
        $titletext = str_replace($trocarIsso, $porIsso, $var);
        return $titletext;
    }

}

// End Template
