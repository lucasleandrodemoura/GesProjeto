<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projeto extends MY_Controller {
    //Utilização padrão
    
    public function index() {
        //Defino o título da página
        $this->setTitulo("Projetos");
        
        $cabecalho = array(
            array("titulo"=>"Código"),
            array("titulo"=>"Nome"),
            array("titulo"=>"Previsão de Conclusão"),
            array("titulo"=>"% Concluído"),
            array("titulo"=>"Ações")
        );
        //Defino o cabecalho da tabela
        $this->setCabecalho($cabecalho);
        
        
        $dados = array();
        $resultados = $this->db->get("projeto")->result();
        foreach($resultados as $item){
          $indices = array(array("id_projeto"=>$item->id_projeto));  
            
          $dados[]["dados"] = array(
              $item->id_projeto,
              $item->descricao_resumida,
              L_label_data($item->data_inclusao, "d/m/Y"),
              L_progress_bar(20.50),
              L_Deletar($indices, "Projeto/excluir")." ".
              L_Editar($indices, "Projeto/editar")." ".
              L_Abrir($indices, "Projeto/abrir")
              );  
        }
        //Defino os dados da tabela
        $this->setLinhas($dados);
       
        
        parent::index();
    }
    
   
    
}
            

        



