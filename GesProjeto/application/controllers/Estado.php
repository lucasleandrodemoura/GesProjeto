<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado extends MY_Controller {
    
    public function index() {
        //Defino o título da página
        $this->setTitulo("Estados");
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Cod IBGE"),
            array("titulo"=>"País"),
            array("titulo"=>"Sigla"),
            array("titulo"=>"Descrição"),
            array("titulo"=>"Ações")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $this->db->select("estado.*,pais.descricao_resumida as pais");
        $this->db->join("pais","estado.cod_pais=pais.id_pais","inner");
        $resultados = $this->db->get("estado")->result();
        foreach($resultados as $item){
          $indices = array(array("id_estado"=>$item->id_estado));  
            
          $dados[]["dados"] = array(
              $item->id_estado,
              $item->codigo_ibge,
              $item->pais,
              $item->sigla,
              $item->descricao_resumida,
              L_Deletar($indices, "estado/excluir")." ".
              L_Editar($indices, "estado/editar")." ".
              L_Abrir($indices, "estado/abrir")
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
    public function cadastro() {
        $this->setTabela("estado");
        $this->setTitulo("Cadastro de estado");
        $this->setAcao("estado/cadastrar");
        parent::cadastro();
    }
    
    public function cadastrar() {
        $this->autentica();
        $this->setTabela("estado");
        parent::cadastrar();
        redirect("estado");
    }
    
    /**
     * Realiza a edição do cadastro
     * @author Lucas Moura <lmoura@universo.univates.br>
     * @param type $indice
     */
    public function editar() {
        $this->setTabela("estado");
        $this->setTitulo("Cadastro de estado");
       
        $this->db->where("id_estado",$this->input->get("id_estado"));
        $this->setDados($this->db->get("estado")->result());
        
        parent::cadastro();
    }
    
}
            

        



