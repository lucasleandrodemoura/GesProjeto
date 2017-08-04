<?php

class ModelLocalEntrega extends CI_Model {
     private $codigo_local_entrega;
     private $descricao_local_entrega;
     private $codigo_sistema;
     private $endereco;
     private $numero;
     private $bairro;
     private $referencia;
     private $latitude_local_entrega;
     private $longitude_local_entrega;
     private $Cliente;
     private $Cidade;
     private $Vendedor;
     private $Filial;
     
     function getCodigo_local_entrega() {
         return $this->codigo_local_entrega;
     }

     function getLongitude_local_entrega() {
         return $this->longitude_local_entrega;
     }

     function setLongitude_local_entrega($longitude_local_entrega) {
         $this->longitude_local_entrega = $longitude_local_entrega;
     }

          
     function getDescricao_local_entrega() {
         return $this->descricao_local_entrega;
     }

     function getCodigo_sistema() {
         return $this->codigo_sistema;
     }

     function getEndereco() {
         return $this->endereco;
     }

     function getNumero() {
         return $this->numero;
     }

     function getBairro() {
         return $this->bairro;
     }

     function getReferencia() {
         return $this->referencia;
     }

     function getLatitude_local_entrega() {
         return $this->latitude_local_entrega;
     }

     function getCliente() {
         return $this->Cliente;
     }

     function getCidade() {
         return $this->Cidade;
     }

     function getVendedor() {
         return $this->Vendedor;
     }

     function getFilial() {
         return $this->Filial;
     }

     function setCodigo_local_entrega($codigo_local_entrega) {
         $this->db->where("codigo_local_entrega",$codigo_local_entrega);
         $retorno = $this->db->get($this->session->userdata('prefixo')."localentrega")->result();
         $this->setBairro($retorno[0]->bairro);
         $this->setCidade($retorno[0]->codigo_cidade);
         $this->setCliente($retorno[0]->codigo_clientes);
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setDescricao_local_entrega($retorno[0]->descricao_local_entrega);
         $this->setEndereco($retorno[0]->endereco);
         $this->setFilial($retorno[0]->codigo_filial);
         $this->setLatitude_local_entrega($retorno[0]->latitude_local_entrega);
         $this->setLongitude_local_entrega($retorno[0]->longitude_local_entrega);
         $this->setNumero($retorno[0]->numero);
         $this->setReferencia($retorno[0]->referencia);
         $this->setVendedor($retorno[0]->codigo_vendedor);
         $this->codigo_local_entrega = $retorno[0]->codigo_local_entrega;
     }
     

     function setDescricao_local_entrega($descricao_local_entrega) {
         $this->descricao_local_entrega = $descricao_local_entrega;
     }

     function setCodigo_sistema($codigo_sistema) {
         $this->codigo_sistema = $codigo_sistema;
     }

     function setEndereco($endereco) {
         $this->endereco = $endereco;
     }

     function setNumero($numero) {
         $this->numero = $numero;
     }

     function setBairro($bairro) {
         $this->bairro = $bairro;
     }

     function setReferencia($referencia) {
         $this->referencia = $referencia;
     }

     function setLatitude_local_entrega($latitude_local_entrega) {
         $this->latitude_local_entrega = $latitude_local_entrega;
     }

     function setCliente($codigo_cliente) {
         $Clientes = new ModelClientes();
         $Clientes->setCodigo_cliente($codigo_cliente);
         $this->Cliente = $Clientes;
     }

     function setCidade($Cidade) {
         $this->Cidade = $Cidade;
     }

     function setVendedor($codigo_vendedor) {
         $Usuario = new ModelUsuario();
         $Usuario->setCodigo_usuario($codigo_vendedor);
         $this->Vendedor = $Usuario;
     }
     

     function setFilial($Filial) {
         $filiais = new ModelFiliais();
         $filiais->setCodigo_filial($Filial);
         $this->Filial = $filiais;
     }

     
     
    

     

}