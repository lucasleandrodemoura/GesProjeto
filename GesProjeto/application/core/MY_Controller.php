<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controladora principal, colocar todas as funções comuns das controladoras para herdar nas controlaras principais
 * @author Lucas Leandro de Moura <lucasleandrodemoura@gmail.com:
 * @data 2017-08-20
 */
class MY_Controller extends CI_Controller {
    protected $codigo_usuario; 
    /**
     * Função responsável em realizar a checagem se existe uma sessão ativa
     * Esta função poder ser utilizado nos controladores que precisam de controle de acesso
     */
    protected function autentica(){
        if($this->session->userdata('logado')){
            $this->codigo_usuario = $this->session->userdata('id_usuario');
        }else{
            redirect("Login");
        }
    }
        

}
            
            

        


        