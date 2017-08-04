<?php

class ModelClientes extends CI_Model {
     private $codigo_cliente;
     private $codigo_sistema;
     private $nome_cliente;
     private $loja;
     private $situacao_financeira_cliente;
     private $documento;
    
  

     function setCodigo_cliente($codigo_cliente) {
         $this->db->where("codigo_clientes",$codigo_cliente);
         $retorno = $this->db->get($this->session->userdata('prefixo')."clientes")->result();
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setDocumento($retorno[0]->documento);
         $this->setLoja($retorno[0]->loja);
         $this->setNome_cliente($retorno[0]->nome_cliente);
         $this->setSituacao_financeira_cliente($retorno[0]->situacao_financeira_cliente);
         $this->codigo_cliente = $retorno[0]->codigo_clientes;
     }
     
     
     function getCodigo_sistema() {
         return $this->codigo_sistema;
     }

     function getNome_cliente() {
         return $this->nome_cliente;
     }

     function getLoja() {
         return $this->loja;
     }

     function getSituacao_financeira_cliente() {
         return $this->situacao_financeira_cliente;
     }

     function getDocumento() {
         return $this->documento;
     }

     function setCodigo_sistema($codigo_sistema) {
         $this->codigo_sistema = $codigo_sistema;
     }

     function setNome_cliente($nome_cliente) {
         $this->nome_cliente = $nome_cliente;
     }

     function setLoja($loja) {
         $this->loja = $loja;
     }

     function setSituacao_financeira_cliente($situacao_financeira_cliente) {
         $this->situacao_financeira_cliente = $situacao_financeira_cliente;
     }

     function setDocumento($documento) {
         $this->documento = $documento;
     }


    
     
     

}