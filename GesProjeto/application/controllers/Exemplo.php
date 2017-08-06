<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exemplo extends MY_Controller {
    
    protected $tabela = "";
    protected $titulo = "";
    
    
    public function index() {
        $this->autentica();
        $this->setWhere("data_sorteio", ">=", "'".date("Y-m-d")."'");
        
        
        parent::index();
    }
    
  
   
}
            

        

