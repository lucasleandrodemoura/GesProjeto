<?php

class ModelFiliais extends CI_Model {
     private $codigo_filial;
     private $nome_filial;
     private $latitude_filial;
     private $longitude_filial;
     private $codigo_sistema;
     private $tempo_carregamento;
     private $tempo_lavagem;
     
  

     function setCodigo_filial($codigo_filial) {
         $this->db->where("codigo_filial",$codigo_filial);
         $retorno = $this->db->get($this->session->userdata('prefixo')."filiais")->result();
         
         $this->setNome_filial($retorno[0]->nome_filial);
         $this->setLatitude_filial($retorno[0]->latitude_filial);
         $this->setLongitude_filial($retorno[0]->longitude_filial);
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setTempo_carregamento($retorno[0]->tempo_carregamento);
         $this->setTempo_lavagem($retorno[0]->tempo_lavagem);
         $this->codigo_filial = $retorno[0]->codigo_filial;
     }
    
     
     function getNome_filial() {
         return $this->nome_filial;
     }

     function getLatitude_filial() {
         return $this->latitude_filial;
     }

     function getLongitude_filial() {
         return $this->longitude_filial;
     }

     function getCodigo_sistema() {
         return $this->codigo_sistema;
     }

     function getTempo_carregamento() {
         return $this->tempo_carregamento;
     }

     function getTempo_lavagem() {
         return $this->tempo_lavagem;
     }

     function setNome_filial($nome_filial) {
         $this->nome_filial = $nome_filial;
     }

     function setLatitude_filial($latitude_filial) {
         $this->latitude_filial = $latitude_filial;
     }

     function setLongitude_filial($longitude_filial) {
         $this->longitude_filial = $longitude_filial;
     }

     function setCodigo_sistema($codigo_sistema) {
         $this->codigo_sistema = $codigo_sistema;
     }

     function setTempo_carregamento($tempo_carregamento) {
         $this->tempo_carregamento = $tempo_carregamento;
     }

     function setTempo_lavagem($tempo_lavagem) {
         $this->tempo_lavagem = $tempo_lavagem;
     }



     

}