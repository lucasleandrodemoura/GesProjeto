<?php

class ModelUsuario extends CI_Model {
     private $codigo_usuario;
     private $nome;
     private $email;
     private $login;
     private $senha;
     private $ativo;
     private $vendedor;
     private $codigo_sistema;
     private $motorista;
     

     
    
     function getCodigo_usuario() {
         return $this->codigo_usuario;
     }

     function getNome() {
         return $this->nome;
     }

     function getEmail() {
         return $this->email;
     }

     function getLogin() {
         return $this->login;
     }

     function getSenha() {
         return $this->senha;
     }

     function getAtivo() {
         return $this->ativo;
     }

     function getVendedor() {
         return $this->vendedor;
     }

     function getCodigo_sistema() {
         return $this->codigo_sistema;
     }

     function getMotorista() {
         return $this->motorista;
     }

     function setCodigo_usuario($codigo_usuario) {
         $this->db->where("codigo_usuario",$codigo_usuario);
         $retorno = $this->db->get($this->session->userdata('prefixo')."usuario")->result();
         $this->setAtivo($retorno[0]->ativo);
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setEmail($retorno[0]->email);
         $this->setLogin($retorno[0]->login);
         $this->setSenha($retorno[0]->senha);
         $this->setMotorista($retorno[0]->motorista);
         $this->setNome($retorno[0]->nome);
         $this->setVendedor($retorno[0]->vendedor);
         $this->codigo_usuario = $retorno[0]->codigo_usuario;
     }

     function setNome($nome) {
         $this->nome = $nome;
     }

     function setEmail($email) {
         $this->email = $email;
     }

     function setLogin($login) {
         $this->login = $login;
     }

     function setSenha($senha) {
         $this->senha = $senha;
     }

     function setAtivo($ativo) {
         $this->ativo = $ativo;
     }

     function setVendedor($vendedor) {
         $this->vendedor = $vendedor;
     }

     function setCodigo_sistema($codigo_sistema) {
         $this->codigo_sistema = $codigo_sistema;
     }

     function setMotorista($motorista) {
         $this->motorista = $motorista;
     }




     

}
