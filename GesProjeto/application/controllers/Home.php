<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    //Utilização padrão
    function index(){
        $this->autentica();
        $this->load->view("Includes/header");
        
        $this->db->where("ativo",true);
        $this->db->order_by("descricao");
        $header_nav["menus"] = $this->db->get("estruturador_menus")->result();
        
        $this->load->view("Includes/header_nav",$header_nav["menus"]);
        $this->load->view("home");
        $this->load->view("Includes/footer");
    }
    
    function test(){
        $this->geraPDF("etatea", "lçmteaçmatelçatmlçaet");
    }
    
    function teste(){
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
        $this->load->view("home");
        $this->load->view("Includes/footer");
    }
    
}
            

        



