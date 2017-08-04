<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Menus extends CI_Model {
    function __construct()
    {
		// Chamar o construtor do Model
		parent::__construct();	
    }
    
    /**
     * Retorna um array com todo o conteúdo de menu
     * @return type
     */
    public function getMenus(){
        $db = $this->load->database("default");
        $prefixo = $this->session->userdata('prefixo');
        $this->db->where("dependencia",null);
        $this->db->where("menu_administrativo",0);
        $this->db->order_by("descricao");
        $resultados = $this->db->get("menus")->result();
        $menu = "";
        
        foreach ($resultados as $item){
            $this->db->where("dependencia",$item->codigo_menu);
            $this->db->where("menu_administrativo",0);
            $this->db->order_by("descricao");
            $resultados_filhos = $this->db->get("menus")->result();
            
            $filhos = "";
            foreach ($resultados_filhos as $item_filho){
                $filhos[$item_filho->codigo_menu] = array("codigo_menu"=>$item_filho->codigo_menu,"descricao"=>$item_filho->descricao,"link"=>$item_filho->link,"icone"=>$item_filho->icone);
            }
            
            $menu[$item->codigo_menu] = array("codigo_menu"=>$item->codigo_menu,"descricao"=>$item->descricao,"link"=>$item->link,"icone"=>$item->icone,"filhos"=>$filhos);
            
        }       
        
        return $menu;        
    }
    
}
