<?php
/**
 * Model responsável pela tabela empresas do sistema
 */
class Master_empresa extends CI_Model {

	function __construct()
	{
		// Chamar o construtor do Model
		parent::__construct();	
	}
        
        private function getAtivo($valor){
            
            if($valor){
                return "Ativo";
            }else{
                return "Inativo";
            }
            
        }
        
        /**
         * Retorna um array com todos os registros em um Array
         * @return type
         */
        public function getEmpresasList(){
            $dados = "";
            
            //Define as linhas da lista
            $this->db->like("nome_empresa",$this->input->post("nome_empresa"));
            if($this->input->post("ativo")!=""){
                $this->db->where("ativo",$this->input->post("ativo"));
            }
            $empresas = $this->db->get("empresa")->result();
            $cont = 1;
            
            
            //Define as Label da lista
            $dados[0] = array("Código","Empresa","URL","Ativo","Ações");
            foreach ($empresas as $item){
                $editar = new Campos();
                $editar->setId("btn_editar_".$item->idempresa);
                $editar->setLabel("<i class='fa fa-edit'></i>");
                $editar->setValue("Master/cadastro_empresa/".$item->idempresa);
                $editar->setTipo("link");
                
                
                $dados[$cont][0] = $item->idempresa;
                $dados[$cont][1] = $item->nome_empresa;
                $dados[$cont][2] = base_url()."Login?uid=".md5($item->idempresa);
                $dados[$cont][3] = $this->getAtivo($item->ativo);
                $dados[$cont][4] = helperCustom_campoFormulario($editar);
                $cont++;
            }
            
       
            
            return $dados;
            
        }
}
