<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lucas Leandro de Moura
 * Controla tudo referente aos usuários
 * @date 2017-09-01
 */
class Usuarios extends MY_Controller {
    
    
    //Tela de login inicial
    function index($erro=""){
      
        
    }
      
    /**
     * Abre a tela de cadastro de usuários
     */
    function cadastro(){
        $this->load->view("Includes/header");
        $data["erro"] = "";
        $data["dados"] = null;
        $this->load->view("usuarios/cadastro",$data);
        $this->load->view("Includes/footer");
    }
    
    /**
     * Responsável por editar o cadastro do usuário logado
     */
    function meus_dados(){
        $this->autentica();
        $id_usuario = $this->session->userdata('id_usuario');
        $this->db->where("id_usuario",$id_usuario);
        $erro["dados"] = $this->db->get("usuario")->result()[0];
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
        $erro["erro"] = "";
        $this->load->view("usuarios/cadastro",$erro);
        $this->load->view("Includes/footer");
    }
    
    function cadastrar(){
        
        $data["nome"] = $this->input->post("nome");
        $data["login"] = $this->input->post("login");
        $data["senha"] = $this->input->post("senha");
        $data["email"] = $this->input->post("email");
        $erro["erro"] = "";
        
        //Avalia regras
        $this->db->select("COUNT(*) as contagem");
        $this->db->where("login",$data["login"]);
        if($this->db->get("usuario")->result()[0]->contagem>0){
            $erro["erro"] = 1;
        }
        
        $this->db->select("COUNT(*) as contagem");
        $this->db->where("email",$data["email"]);
        if($this->db->get("usuario")->result()[0]->contagem>0){
            $erro["erro"] = 2;
        }
        
        
        if($erro["erro"]!=""){
            $this->load->view("Includes/header");
            $this->load->view("usuarios/cadastro",$erro);
            $this->load->view("Includes/footer");
        }else{
            //Faz a inclusão
            $this->db->insert("usuario",$data);
            $mensagem = "Olá ".$data["nome"]." (".$data["login"].") sua nova senha para o site ". base_url()." será ".$data["senha"];
            $this->enviar_email($data["email"], "Cadastrado no sistema", $mensagem);
            redirect("Login/3");
        }
    }
    
   
}
            

        

