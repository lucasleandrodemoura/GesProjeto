<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Cadastros extends CI_Model {
    private $entidade;
    private $indice;
    private $where = array();
    
    function __construct()
    {
		// Chamar o construtor do Model
		parent::__construct();	
                
    }
    
    
    public function setWhere($key,$operador,$valor){
        
        $this->where[] = array($key,$operador,$valor);
        
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
            if(sizeof($this->indice)>0){
                $Campos->setValue($this->buscaValue($this->entidade, $Campos->getColuna()));
            }
            $retorno[] = $Campos;
        }
          
        return $retorno;
    }
    
    /**
     * Busca o valor do campo respeitando a regra de filtro aplicada na construção do objeto
     * @param type $entidade
     * @author Lucas Leandro de Moura
     * @param type $campo
     * @return type
     */
    private function buscaValue($entidade,$campo){
        $this->db->select($campo." as campo");
        foreach ($this->indice as $key=>$value){
            $this->db->where($key,$value);
        }
        $resultados = $this->db->get($entidade)->result();
        return $resultados[0]->campo;
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
        
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////FIM = MONTA OS DADOS////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        
        ////Aplica filtro
        $conteudo["cabecalho"] = $retornoCAB;
        $this->db->select(implode(",",$key));
        foreach($this->input->post() as $key=>$valor){
            if($key!="procurar"){
                $this->db->like($key,$valor);
            }
        }
        
        
        //Executa consulta
        foreach($this->input->get() as $coluna=>$valor){
            if($coluna!="ref"){
                $this->db->where($coluna,$valor);
            }
        }
        
        if(is_array($this->where)){
            //Pega os filtros customizados
            foreach($this->where as $aWhere){

                    $this->db->where($aWhere[0]."".$aWhere[1]."".$aWhere[2]);

            }
        }
        
        
        
        $resultados = $this->db->get($entidade)->result();
        
        $tabela = explode("_",$entidade);
        $prefixo = $tabela[0];
        $tabela = $tabela[1];
        
        $contagem = 0;
        $conteudo["dados"] = "";
        foreach($resultados as $r){
            $conteudo["dados"][$contagem] = get_object_vars($r);
            //Vamos procurar se uma das chaves é FK, se for, pegamos o campo descrição do mesmo para exibir na tela
            foreach($conteudo["dados"][$contagem] as $chave_tabela=>$valor_tabela){
                $this->db->where("TABELA_ORIGINAL",$entidade);
                $this->db->where("COLUNA_ORIGINAL",$chave_tabela);
                $resultadosFK = $this->db->get("xreferencias")->result();
                
                
                if(sizeof($resultadosFK)>0){
                    //Pega qual é o campo de label desta tabela
                    $this->db->where("coluna",$chave_tabela);
                    $this->db->where("tabela",$tabela);
                    $descricao = $this->db->get("estruturador")->result()[0]->fk_descricao;
                    
                    if($descricao){
                        //Monta a where conforme os campos encontrados
                        foreach($resultadosFK as $campos){
                            $this->db->where($campos->COLUNA_REFERENCIADA,$conteudo["dados"][$contagem][$chave_tabela]);
                        }
                        //Seleciona o valor na tabela e substitui no vetor
                        $this->db->select($descricao." as label");
                        $valor_novo = $this->db->get($campos->TABELA_REFERENCIADA)->result()[0]->label;
                        $conteudo["dados"][$contagem][$chave_tabela] = $valor_novo;
                    }
                    
                    
                }
            }
            //Encontra todas as chaves primárias desta tabela
            foreach($primary as $labelPrimaria=>$chavePrimaria){
               
                $conteudo["dados"][$contagem]["key"][$labelPrimaria] = $conteudo["dados"][$contagem][$chavePrimaria];
            }
            $contagem++;
        }
        
        
        
        
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////FIM = MONTA OS DADOS////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////MONTA OS FILTROS////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        
        //Filtros
        $this->db->select("xcadastro.*");
        $this->db->where("xcadastro.TABELA", $this->entidade);
        
        $where = "estruturador ON xcadastro.TABELA = concat('".$this->session->userdata('prefixo')."',estruturador.tabela) "
                . "AND estruturador.coluna = xcadastro.coluna "
                . "AND estruturador.mbrowser = 1 "
                . "AND xcadastro.chave = 'MUL'";
        $this->db->join("estruturador",$where,"inner");
        foreach($this->input->get() as $coluna=>$valor){
            $this->db->where("estruturador.coluna != ",$coluna);
        }
        $dados = $this->db->get("xcadastro")->result();
        foreach($dados as $item){
            $Campos = new Campos();
            $Campos->AlimentaCamposXCadastro($item);
            $Campos->setNulo("NO");
            $Campos->setValue($this->input->post($item->COLUNA));
            $retornoFiltros[] = $Campos;
        }
        $conteudo["filtros"] = $retornoFiltros;
        
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////FIM = MONTA OS FILTROS//////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        
        return $conteudo;
    }

   
}

