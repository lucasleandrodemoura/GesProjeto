<?php

class ModelTiposEstruturas extends CI_Model {
     private $codigo_estrutura;
     private $codigo_sistema;
     private $descricao;
     private $ativo;
     
     function getCodigo_estrutura() {
         return $this->codigo_estrutura;
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

     function setCodigo_estrutura($codigo_estrutura) {
         $this->db->where("codigo_estrutura",$codigo_estrutura);
         $retorno = $this->db->get($this->session->userdata('prefixo')."tiposestruturas")->result();
         $this->setAtivo($retorno[0]->ativo);
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setDescricao($retorno[0]->descricao);
         $this->codigo_estrutura = $retorno[0]->codigo_estrutura;
         
         
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

     

}