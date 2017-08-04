<?php
/**
 * Classe que armazena informações de um campo de formulário genérico
 */
class ModelPedido extends CI_Model {
     private $codigo_pedido;
     private $codigo_sistema;
     private $TipoEstruturas;
     private $Filiais;
     private $data_pedido;
     private $LocalEntrega;
     private $Usuario;
     private $observacao;
     private $data_primeira_entrega;
     private $obra_finalizada;
          
     function setTipoEstruturas($codigo_estrutura) {
         $tiposEstruturas = new ModelTiposEstruturas();
         $tiposEstruturas->setCodigo_estrutura($codigo_estrutura);
         $this->TipoEstruturas = $tiposEstruturas;
     }
     
     function setFiliais($codigo_filial) {
         $filiais = new ModelFiliais();
         $filiais->setCodigo_filial($codigo_filial);
         $this->Filiais = $filiais;
     }
     
     function getTipoEstruturas() {
         return $this->TipoEstruturas;
     }

     function getFiliais() {
         return $this->Filiais;
     }

     function setLocalEntrega($codigo_local_entrega) {
         $LocalEntrega = new ModelLocalEntrega();
         $LocalEntrega->setCodigo_local_entrega($codigo_local_entrega);
         $this->LocalEntrega = $LocalEntrega;
     }
     
     function getLocalEntrega() {
         return $this->LocalEntrega;
     }

     
     function setUsuario($codigo_usuario){
         $Usuario = new ModelUsuario();
         $Usuario->setCodigo_usuario($codigo_usuario);
         $this->Usuario = $Usuario;
     }
     
     function getCodigo_pedido() {
         return $this->codigo_pedido;
     }

     function getCodigo_sistema() {
         return $this->codigo_sistema;
     }

     function getData_pedido() {
         return $this->data_pedido;
     }

     function getObservacao() {
         return $this->observacao;
     }

     function getData_primeira_entrega() {
         return $this->data_primeira_entrega;
     }

     function getObra_finalizada() {
         return $this->obra_finalizada;
     }

     function setCodigo_pedido($codigo_pedido) {
         $this->db->where("codigo_pedido",$codigo_pedido);
         $retorno = $this->db->get($this->session->userdata('prefixo')."pedido")->result();
         $this->setCodigo_sistema($retorno[0]->codigo_sistema);
         $this->setData_pedido($retorno[0]->data_pedido);
         $this->setData_primeira_entrega($retorno[0]->data_primeira_entrega);
         $this->setFiliais($retorno[0]->codigo_filial);
         $this->setLocalEntrega($retorno[0]->codigo_local_entrega);
         $this->setObra_finalizada($retorno[0]->obra_finalizada);
         $this->setObservacao($retorno[0]->observacao);
         $this->setTipoEstruturas($retorno[0]->codigo_estrutura);
         $this->setUsuario($retorno[0]->codigo_usuario);
         $this->codigo_pedido = $codigo_pedido;
     }

     function setCodigo_sistema($codigo_sistema) {
         $this->codigo_sistema = $codigo_sistema;
     }

     function setData_pedido($data_pedido) {
         $this->data_pedido = $data_pedido;
     }

     function setObservacao($observacao) {
         $this->observacao = $observacao;
     }

     function setData_primeira_entrega($data_primeira_entrega) {
         $this->data_primeira_entrega = $data_primeira_entrega;
     }

     function setObra_finalizada($obra_finalizada) {
         $this->obra_finalizada = $obra_finalizada;
     }


     
     


     
     
     
     

}