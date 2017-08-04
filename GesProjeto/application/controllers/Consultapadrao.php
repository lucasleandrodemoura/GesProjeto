<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultapadrao extends MY_Controller {
    
    protected $tabela = "";
    protected $titulo = "Caminhões";
    
    function index() {
        $this->autentica();
            
        $tabela = $this->input->get("ref");
   
            
        $info["novo"] = "";
        $info["src"] = "consultapadrao?ref=".$tabela;
        $info["titulo"] = "";
        $info["editar"] = FALSE;
        $info["seleciona"] = TRUE;
        $info["acoes"] = FALSE;
        $info["botaoVoltar"] = "";
            
            
        $mbrowser = new Cadastros();
        
        $info["dados"] = $mbrowser->mBrowser($tabela);
            
            
        $menus = new Menus();
        $dataMenu["menus"] = $menus->getMenus();
            
        $this->load->view("Includes/header");    
        $this->load->view("list",$info);
        $this->load->view("Includes/footer"); 
            
    }

   
}
            
            

        

