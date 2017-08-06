<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    //Utilização padrão
    function index(){
        $sql = "";
        
        $data["dados"] = "Ola pessoal";
        //$this->db->select("campo as t, campo2 as g");
        //$this->db->where("coluna","valor");
        //$this->db->where("coluna!=valor");
        //$this->db->order_by("campo,campo2");
        //$this->db->join("tabela","tabela.codigo = nome_tabela.codigo_ccc","left");        
        //$data["resultado_consulta"] = $this->db->get("nome_tabela")->result();
        
        
        //$dados["coluna_1"] = "teataeaet";
        //$dados["coluna_2"] = "teataeaet";
        //$dados["coluna_3"] = "teataeaet";
        //$dados["coluna_4"] = "teataeaet";
        //$this->db->insert("tabela",$dados);
        
        //$this->db->where("coluna",1);
        //$this->db->update("tabela",$dados);
        
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
      
        $this->load->view("home",$data);
        $this->load->view("Includes/footer");
        
    }
    
   
}
            

        

