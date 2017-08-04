<?php
/**
 * Classe que armazena informações de um campo de formulário genérico
 */
class ModelProdutos extends CI_Model {
     private $codigo_produtos;
     private $codigo_sistema;
     private $descricao;
     private $ativo;
     private $codigo_familia_produtos;
         
     function setCodigoProdutos($codigo_produto) {
         $this->db->where("codigo_produtos",$codigo_produto);
         $retorno = $this->db->get($this->session->userdata('prefixo')."produtos")->result();
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setAtivo($retorno[0]->ativo);
         $this->setCodigo_familia_produtos($retorno[0]->codigo_familia_produtos);
         $this->setDescricao($retorno[0]->descricao);
         $this->codigo_produtos = $retorno[0]->codigo_produtos;
     }
     
     
     function getCodigo_produtos() {
         return $this->codigo_produtos;
     }

     function getCodigo_sistema() {
         return $this->codigo_sistema;
     }

     function getDescricao() {
         return $this->descricao;
     }

     function getAtivo() {
         return $this->ativo;
     }

     function getCodigo_familia_produtos() {
         return $this->codigo_familia_produtos;
     }

     function setCodigo_produtos($codigo_produtos) {
         $this->codigo_produtos = $codigo_produtos;
     }

     function setCodigo_sistema($codigo_sistema) {
         $this->codigo_sistema = $codigo_sistema;
     }

     function setDescricao($descricao) {
         $this->descricao = $descricao;
     }

     function setAtivo($ativo) {
         $this->ativo = $ativo;
     }

     function setCodigo_familia_produtos($codigo_familia_produtos) {
         $this->codigo_familia_produtos = $codigo_familia_produtos;
     }


     
   

     

     
     


     
     
     
     

}