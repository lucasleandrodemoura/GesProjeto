<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lucas Leandro de Moura
 * Controle que realizar autenticações e todo o sistema envolvendo o login e segurança
 * @date 2017-08-21
 */
class Home extends CI_Controller {
    
    //Tela de login inicial
    function index(){
        $this->load->view("Includes/header");
        $this->load->view("login");
        $this->load->view("Includes/footer");
        
    }
    
       
    
    
   
}
            

        

