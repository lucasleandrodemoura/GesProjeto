<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setor extends MY_Controller {

    public function index() {
        //Defino o título da página
        $this->setTitulo("Setores");
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Descrição"),
            array("titulo"=>"Ativo"),
            array("titulo"=>"Ações")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $resultados = $this->db->get("setor")->result();
        foreach($resultados as $item){
          $indices = array(array("id_setor"=>$item->id_setor));  
            
          $dados[]["dados"] = array(
              $item->id_setor,
              $item->descricao_resumida,
              L_boolean($item->ativo),
              L_Deletar($indices, "setor/excluir")." ".
              L_Editar($indices, "setor/editar")." ".
              L_Abrir($indices, "setor/abrir")
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
    public function cadastro() {
        $this->setTabela("setor");
        $this->setTitulo("Cadastro de setor");
        $this->setAcao("setor/cadastrar");
        parent::cadastro();
    }
    
    public function cadastrar() {
        $this->autentica();
        $this->setTabela("setor");
        $data["cod_usuario_chefe"] = $this->codigo_usuario;
        $this->setData($data);
        parent::cadastrar();
        redirect("setor");
    }
    
    /**
     * Realiza a edição do cadastro
     * @author Lucas Moura <lmoura@universo.univates.br>
     * @param type $indice
     */
    public function editar() {
        $this->setTabela("setor");
        $this->setTitulo("Cadastro de setor");
       
        $this->db->where("id_setor",$this->input->get("id_setor"));
        $this->setDados($this->db->get("setor")->result());
        
        parent::cadastro();
    }
    
}
            

        



