<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Cadastros extends CI_Model {
    private $entidade;
    private $indice;
    
    function __construct()
    {
		// Chamar o construtor do Model
		parent::__construct();	
                
    }
   
    
    /**
     * Retorna campos de uma entidade no banco de dados
     * @param string $entidade Nome da entidade que será utilizada para consulta
     * @return array() Retorna um array com todas as informações dos campos da entidade
     */
    public function xCadastro($entidade){
        $retorno = [];
        $Campos;
        
        $this->entidade = $entidade;
        $this->db->select("xcadastro.*");
        $this->db->where("xcadastro.TABELA", $this->entidade);
        $where = "estruturador ON xcadastro.TABELA = concat('".$this->session->userdata('prefixo')."',estruturador.tabela) AND estruturador.coluna = xcadastro.coluna AND estruturador.xcadastro = 1";
        $this->db->join("estruturador",$where,"inner");
        $dados = $this->db->get("xcadastro")->result();
        
        
        foreach($dados as $item){
            $Campos = new Campos();
            $Campos->AlimentaCamposXCadastro($item);
            $retorno[] = $Campos;
        }
        
        
        return $retorno;
    }
    
    /**
     * Caso houver alguma chave para informar
     * @param type $indice
     */
    public function setEditar($indice) {
        $this->indice = $indice;
    }

    
    
    
    public function mBrowser($entidade){
        $retornoCAB = [];
        $retornoFiltros = [];
        $Campos;
        
        $this->entidade = $entidade;
        $this->db->select("xcadastro.*");
        $this->db->where("xcadastro.TABELA", $this->entidade);
        $where = "estruturador ON xcadastro.TABELA = concat('".$this->session->userdata('prefixo')."',estruturador.tabela) AND estruturador.coluna = xcadastro.coluna AND estruturador.mbrowser = 1";
        $this->db->join("estruturador",$where,"inner");
        $dados = $this->db->get("xcadastro")->result();
        
        $key = [];
        $primary = [];
        foreach($dados as $item){
            $Campos = new Campos();
            $Campos->AlimentaCamposXCadastro($item);
            $retornoCAB[] = $Campos->getLabel_padrao();
            
            if($Campos->getTipo_dado()=="boolean"){
               $key[] = "(CASE ".$Campos->getColuna()." WHEN 1 THEN 'Sim' ELSE 'NÃO' END) as ".$Campos->getColuna();
            }else{
              $key[] = $Campos->getColuna();
            }
            
            if($item->CHAVE=='PRI'){
                $primary[$Campos->getColuna()] = $Campos->getColuna();
            }
            
        }
        
        
        //Coleta os dados para a tabela
        $conteudo["cabecalho"] = $retornoCAB;
        $this->db->select(implode(",",$key));
        foreach($this->input->post() as $key=>$valor){
            if($key!="procurar"){
                $this->db->like($key,$valor);
            }
        }
        
        $resultados = $this->db->get($entidade)->result();
        $contagem = 0;
        $conteudo["dados"] = "";
        foreach($resultados as $r){
            $conteudo["dados"][$contagem] = get_object_vars($r);
            foreach($primary as $labelPrimaria=>$chavePrimaria){
                $conteudo["dados"][$contagem]["key"][$labelPrimaria] = $conteudo["dados"][$contagem][$chavePrimaria];
            }
            $contagem++;
        }
        
        
        
        //Filtros
        $this->db->select("xcadastro.*");
        $this->db->where("xcadastro.TABELA", $this->entidade);
        $where = "estruturador ON xcadastro.TABELA = concat('".$this->session->userdata('prefixo')."',estruturador.tabela) "
                . "AND estruturador.coluna = xcadastro.coluna "
                . "AND estruturador.mbrowser = 1 "
                . "AND xcadastro.chave = 'MUL'";
        $this->db->join("estruturador",$where,"inner");
        $dados = $this->db->get("xcadastro")->result();
        foreach($dados as $item){
            $Campos = new Campos();
            $Campos->AlimentaCamposXCadastro($item);
            $Campos->setNulo("NO");
            $Campos->setValue($this->input->post($item->COLUNA));
            $retornoFiltros[] = $Campos;
        }
        $conteudo["filtros"] = $retornoFiltros;
        
        
        
        
        
        return $conteudo;
    }

   
}

