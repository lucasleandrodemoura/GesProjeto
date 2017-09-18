<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador responsável por construir o estruturador de dados
 * Com estas informações, é possível construir telas genéricas de cadastro
 */
class Estruturador extends MY_Controller {
    //Utilização padrão
    
    public function index() {
        //Defino o título da página
        $this->setTitulo("Estruturador");
        
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Tabela"),
            array("titulo"=>"Coluna"),
            array("titulo"=>"Rótulo"),
            array("titulo"=>"Tipo de Campo"),
            array("titulo"=>"Tipo de Valor"),
            array("titulo"=>"Ordenação")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $resultados = $this->db->get("estruturador")->result();
        foreach($resultados as $item){
          $indices = array(array("codigo_campo"=>$item->codigo_campo));  
            
          $dados[]["dados"] = array(
              $item->codigo_campo,
              $item->tabela,
              $item->coluna,
              $item->rotulo,
              $item->tipo_campo,
              $item->tipo_valor,
              $item->ordenacao
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
    public function cadastro() {
        $this->setTabela("projeto");
        $this->setTitulo("Cadastro de projetos");
        
       
        parent::cadastro();
    }
    
    /**
     * Realiza a edição do cadastro
     * @author Lucas Moura <lmoura@universo.univates.br>
     * @param type $indice
     */
    public function editar() {
        $this->setTabela("projeto");
        $this->setTitulo("Cadastro de projetos");
       
        $this->db->where("id_projeto",$this->input->get("id_projeto"));
        $this->setDados($this->db->get("projeto")->result());
        
        parent::cadastro();
    }
    
}
            

        



