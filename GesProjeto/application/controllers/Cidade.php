<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade extends MY_Controller {
    
    public function index() {
        //Defino o título da página
        $this->setTitulo("Cidades");
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Cod IBGE"),
            array("titulo"=>"Estado"),
       
            array("titulo"=>"Descrição"),
            array("titulo"=>"Ações")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $this->db->select("cidade.*,estado.sigla as estado");
        $this->db->join("estado","cidade.cod_estado=estado.id_estado","inner");
        $resultados = $this->db->get("cidade")->result();
        foreach($resultados as $item){
          $indices = array(array("id_cidade"=>$item->id_cidade));  
            
          $dados[]["dados"] = array(
              $item->id_cidade,
              $item->codigo_ibge,
              $item->estado,
           
              $item->descricao_resumida,
              L_Deletar($indices, "cidade/excluir")." ".
              L_Editar($indices, "cidade/editar")." ".
              L_Abrir($indices, "cidade/abrir")
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
    public function cadastro() {
        $this->setTabela("cidade");
        $this->setTitulo("Cadastro de cidade");
        $this->setAcao("cidade/cadastrar");
        parent::cadastro();
    }
    
    public function cadastrar() {
        $this->autentica();
        $this->setTabela("cidade");
        parent::cadastrar();
        redirect("cidade");
    }
    
    /**
     * Realiza a edição do cadastro
     * @author Lucas Moura <lmoura@universo.univates.br>
     * @param type $indice
     */
    public function editar() {
        $this->setTabela("cidade");
        $this->setTitulo("Cadastro de cidade");
       
        $this->db->where("id_cidade",$this->input->get("id_cidade"));
        $this->setDados($this->db->get("cidade")->result());
        
        parent::cadastro();
    }
    
}
            

        



