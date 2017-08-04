<?php
/**
 * Classe que armazena informações de um campo de formulário genérico
 */
class ModelOrdensEntrega extends CI_Model {
     private $codigo_ordem;
     private $codigo_pedido;
     private $codigo_produto;
     private $quantidade;
     private $data_hora;
     private $obra_confirmada;
          
     function getCodigo_pedido() {
         return $this->codigo_pedido;
     }

     function getQuantidade() {
         return $this->quantidade;
     }

     function getData_hora() {
         return $this->data_hora;
     }

     function getObra_confirmada() {
         return $this->obra_confirmada;
     }
     
     function setCodigo_pedido($codigo) {
         $objeto = new ModelPedido();
         $objeto->setCodigo_pedido($codigo);
         $this->codigo_pedido = $objeto;
     }

     function setQuantidade($quantidade) {
         $this->quantidade = $quantidade;
     }

     function setData_hora($data_hora) {
         $this->data_hora = $data_hora;
     }

     function setObra_confirmada($obra_confirmada) {
         $this->obra_confirmada = $obra_confirmada;
     }

          
     function setCodigo_ordem($codigo_ordem) {
         $this->db->where("codigo_ordem",$codigo_ordem);
         $retorno = $this->db->get($this->session->userdata('prefixo')."ordensentrega")->result();
         $this->setCodigo_pedido($retorno[0]->codigo_pedido);
         $this->setCodigo_produto($retorno[0]->codigo_produto);
         $this->setData_hora($retorno[0]->data_hora);
         $this->setObra_confirmada($retorno[0]->obra_confirmada);
         $this->setQuantidade($retorno[0]->quantidade);
         $this->codigo_ordem = $retorno[0]->codigo_ordem;
     }
     
     function getCodigo_produto() {
         return $this->codigo_produto;
     }

     function setCodigo_produto($codigo_produto) {
         $objeto = new ModelProdutos();
         $objeto->setCodigoProdutos($codigo_produto);
         $this->codigo_produto = $objeto;
     }


     

     
     


     
     
     
     

}