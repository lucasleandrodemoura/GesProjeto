<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pais extends MY_Controller {

    public function index() {
        //Defino o título da página
        $this->setTitulo("Países");
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Cod IBGE"),
            array("titulo"=>"Sigla"),
            array("titulo"=>"Descrição"),
            array("titulo"=>"Ações")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $resultados = $this->db->get("pais")->result();
        foreach($resultados as $item){
          $indices = array(array("id_pais"=>$item->id_pais));  
            
          $dados[]["dados"] = array(
              $item->id_pais,
              $item->codigo_ibge,
              $item->sigla,
              $item->descricao_resumida,
              L_Deletar($indices, "pais/excluir")." ".
              L_Editar($indices, "pais/editar")." ".
              L_Abrir($indices, "pais/abrir")
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
    public function cadastro() {
        $this->setTabela("pais");
        $this->setTitulo("Cadastro de país");
        $this->setAcao("pais/cadastrar");
        parent::cadastro();
    }
    
    public function cadastrar() {
        $this->autentica();
        $this->setTabela("pais");
        parent::cadastrar();
        redirect("pais");
    }
    
    /**
     * Realiza a edição do cadastro
     * @author Lucas Moura <lmoura@universo.univates.br>
     * @param type $indice
     */
    public function editar() {
        $this->setTabela("pais");
        $this->setTitulo("Cadastro de pais");
       
        $this->db->where("id_pais",$this->input->get("id_pais"));
        $this->setDados($this->db->get("pais")->result());
        
        parent::cadastro();
    }
    
}
            

        



