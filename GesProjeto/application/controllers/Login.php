<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
        
	public function index()
	{
            $DB_Custom = $this->load->database($this->db);
            
            $dados["img_logo"] = "icon_256.png";
            
            
            $dados["src_form"] = "Login/logar";
            $dados["erro"] = $this->input->get("erro");
            
            $this->load->view("Includes/header");
            
            $this->load->view("Login/form",$dados);
            $this->load->view("Includes/footer");
            
            
	}
        
        /**
         * Função que cria as tabelas
         * @param type $prefixo
         */
        private function atualiza_base($prefixo){
            
            
        }
        
        public function logar(){
            
                        
            $login = $this->input->post("login");
            $senha = $this->input->post("senha");
           
            $prefixo = "su_";
           

                $this->db->where("login",$login);
                $this->db->where("senha",$senha);
                $this->db->where("ativo",TRUE);
                $data = $this->db->get($prefixo."usuario")->result();

                $count = count($data);
                if($count>0){

                    $data["prefixo"] = $prefixo;
                    $data["codigo_usuario"] = $data[0]->codigo_usuario;
                    $data["nome"] = $data[0]->nome;
                    $data["email"] = $this->input->post("email");
                    $data["login"] = $this->input->post("login");
                    $data["logado"] = TRUE;
                    $this->session->set_userdata($data);

                    redirect('home');
                }else{

                    redirect("Login?erro=1");
                }
            
            
          
            
        }
        
       

}

