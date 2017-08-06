<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    //Utilização padrão
    function index(){
        $sql = "";
        
        $data["dados"] = "Ola pessoal";
        
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
      
        $this->load->view("home",$data);
        $this->load->view("Includes/footer");
        
    }
    
   
}
            

        

