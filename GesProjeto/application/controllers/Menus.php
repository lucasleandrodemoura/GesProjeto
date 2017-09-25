<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Menus extends MY_Controller {
    //Utilização padrão
    
   

    public function index() {
        //Defino o título da página
        $this->setTitulo("Menus do sistema");
        
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Descrição"),
            array("titulo"=>"Link"),
            array("titulo"=>"Ícone"),
            array("titulo"=>"Ativo"),
            array("titulo"=>"Ações")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $resultados = $this->db->get("estruturador_menus")->result();
        foreach($resultados as $item){
          $indices = array(array("codigo_menu"=>$item->codigo_menu));  
            
          $dados[]["dados"] = array(
              $item->codigo_menu,
              $item->descricao,
              $item->link,
              "<i class='fa ".$item->simbolo."'></i>",
              L_boolean($item->ativo),
              L_Deletar($indices, "menus/excluir")." ".
              L_Editar($indices, "menus/editar")
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
    public function cadastro() {
        $this->setTabela("estruturador_menus");
        $this->setTitulo("Cadastro de menus");
        $this->setAcao("menus/cadastrar");
        
       
        parent::cadastro();
    }
    
    public function cadastrar() {
        $this->setTabela("estruturador_menus");
        parent::cadastrar();
        redirect("Menus");
    }
    
    /**
     * Realiza a edição do cadastro
     * @author Lucas Moura <lmoura@universo.univates.br>
     * @param type $indice
     */
    public function editar() {
        $this->setTabela("estruturador_menus");
        $this->setTitulo("Cadastro de menus do sistema");
       
        $this->db->where("codigo_menu",$this->input->get("codigo_menu"));
        $this->setDados($this->db->get("estruturador_menus")->result());
        
        parent::cadastro();
    }
    
}
            

        



