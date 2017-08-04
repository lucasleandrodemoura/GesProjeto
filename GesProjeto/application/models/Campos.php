<?php
/**
 * Classe que armazena informações de um campo de formulário genérico
 */
class Campos extends CI_Model {
        private $coluna;
        private $nulo;
        private $tipo_dado;
        private $tamanho_maximo;
        private $numero_precisa;
        private $casa_decimal;
        private $chave;
        private $extra;
        private $tabela;
        private $comentario;
        private $label_padrao;
        private $valor_padrao;
        private $estruturador;
        private $value;
        private $mascara;
        private $dependencia;
        private $descricao_dependencia;
        
        function __construct(){
            parent::__construct();
        }
        
        function AlimentaCamposXCadastro($xCadastro){
            $this->setCasa_decimal($xCadastro->CASA_DECIMAL);
            $this->setChave($xCadastro->CHAVE);
            $this->setColuna($xCadastro->COLUNA);
            $this->setTabela($xCadastro->TABELA);
            $this->setExtra($xCadastro->EXTRA);
            $this->setNulo($xCadastro->NULO);
            $this->setNumero_precisa($xCadastro->NUMERO_PRECISA);
            $this->setTamanho_maximo($xCadastro->TAMANHO_MAXIMO);
            $this->setTipo_dado($xCadastro->TIPO_DADO);
            $this->setComentario($xCadastro->COMENTARIO);
            $this->setDependencia();
            $this->Estruturador();
            $this->setLabel_padrao();
            $this->setMascara();
            
            
        }
        /**
         * Retorna a fk do banco caso haja dependência
         * @return type
         */
        function getDependencia() {
            return $this->dependencia;
        }
        
        function getDescricao_dependencia() {
            return $this->descricao_dependencia;
        }

        function setDescricao_dependencia($descricao_dependencia) {
            $this->descricao_dependencia = $descricao_dependencia;
        }

        
        function setDependencia() {
            $this->db->where("TABELA_ORIGINAL",$this->getTabela());
            $this->db->where("COLUNA_ORIGINAL",$this->getColuna());
            
            $this->dependencia = $this->db->get("xreferencias")->result();
            
        }

        function getValue() {
            return $this->value;
        }

        function setValue($value) {     
            $this->value = $value;
        }

                
        function getLabel_padrao() {
            return $this->label_padrao;
        }
        
        function getMascara() {
            return $this->mascara;
        }

        function setMascara(){
            $this->mascara = $this->estruturador->mascara;
        }
                
        /**
         * Consulta informações dos campos no banco de dados, na tabela estruturador
         */
        private function Estruturador(){
            $sufixo = explode("_",$this->getTabela());
            $this->db->where("tabela",$sufixo[1]);
            $this->db->where("coluna", $this->getColuna());
            $this->estruturador = $this->db->get("estruturador")->result()[0];
        }
        
        /**
         * Informa a label deste campo
         */
        function setLabel_padrao() {
            
            $this->label_padrao = $this->estruturador->label_pt;
        }

        function getComentario() {
            return $this->comentario;
        }

        function setComentario($comentario) {
            $this->comentario = $comentario;
        }

        function getTabela() {
            return $this->tabela;
        }

        private function setTabela($tabela) {
            $this->tabela = $tabela;
        }

        
       /**
         * Retorna o nome da Label do campo
         * @return type
         */
	
        function getColuna() {
            return $this->coluna;
        }

        function getNulo() {
            return $this->nulo;
        }

        function getTipo_dado() {
            return $this->tipo_dado;
        }

        function getTamanho_maximo() {
            return $this->tamanho_maximo;
        }

        function getNumero_precisa() {
            return $this->numero_precisa;
        }

        function getCasa_decimal() {
            return $this->casa_decimal;
        }

        function getChave() {
            return $this->chave;
        }

        function getExtra() {
            return $this->extra;
        }

  

        function setColuna($coluna) {
            $this->coluna = $coluna;
        }

        function setNulo($nulo) {
            $this->nulo = $nulo;
            
        }

        function setTipo_dado($tipo_dado) {
            if($tipo_dado=="varchar"){
                $tipo_dado = "text";
            }
            else if($tipo_dado=="int"){
                $tipo_dado = "number";
            }else if($tipo_dado=="tinyint"){
                $tipo_dado = "boolean";
            }    
            else if($tipo_dado=="text"){
                $tipo_dado = "memo";
            }  
            else if($tipo_dado=="date"){
                $tipo_dado = "date";
            }
            else{
                $tipo_dado = "text";
            }
            $this->tipo_dado = $tipo_dado;
        }

        function setTamanho_maximo($tamanho_maximo) {
            $this->tamanho_maximo = $tamanho_maximo;
        }

        function setNumero_precisa($numero_precisa) {
            $this->numero_precisa = $numero_precisa;
        }

        function setCasa_decimal($casa_decimal) {
            $this->casa_decimal = $casa_decimal;
        }

        function setChave($chave) {
            $this->chave = $chave;
        }

        function setExtra($extra) {
            $this->extra = $extra;
        }

    

}