<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lucas Leandro de Moura
 * Controle que realizar autenticações e todo o sistema envolvendo o login e segurança
 * @date 2017-08-21
 */
class Login extends CI_Controller {
    
    //Tela de login inicial
    function index(){
         
        $this->load->view("Includes/header");
        $data["erro"] = "";
        $this->load->view("login",$data);
        $this->load->view("Includes/footer");
        
    }
    
    /**
     * Realiza a autenticação do usuário
     */
    function logar(){
        $login = $this->input->post("login");
        $senha = $this->input->post("senha");
        $this->db->where("login",$login);
        $this->db->where("senha",$senha);
        $this->db->where("ativo",true);
        $resultados = $this->db->get("usuario")->result();
        foreach ($resultados as $item){
            $infoSessao["login"] = $login;
        
            $infoSessao["id_usuario"] = $item->id_usuario;
            $infoSessao["nome"] = $item->nome;
            $infoSessao["logado"] = TRUE;
            
            
            
            $this->session->userdata($infoSessao);
            
        }
        
        if($this->session->userdata('logado')){
            redirect("Home");
        }else{
            redirect("Login");
        }
        
    }
       
    
    
   
}
            

        

