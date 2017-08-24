<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    //Utilização padrão
    function index(){
        $this->autentica();
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
        $this->load->view("home");
        $this->load->view("Includes/footer");
    }
    
    
    function cadastro(){
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
        $data["dados"] = $this->db->get("clientes")->result();
        
        $this->load->view("cliente_cadastro",$data);
        $this->load->view("Includes/footer");
    }
    
    
    function cadastrar(){
        
        $dados["nome"] = $this->input->post("nome");
        $dados["cidade"]= $this->input->post("cidade");
        $dados["estado"]= $this->input->post("estado");
        
     
        $this->db->insert("clientes",$dados);
        
        redirect("home/cadastro");
     
        
    }
    
   
}
            

        

