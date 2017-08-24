<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lucas Leandro de Moura
 * Controle que realizar autenticações e todo o sistema envolvendo o login e segurança
 * @date 2017-08-21
 */
class Login extends CI_Controller {
    
    //Tela de login inicial
    function index($erro=""){
         
        $this->load->view("Includes/header");
        $data["erro"] = $erro;
        $this->load->view("login/login",$data);
        $this->load->view("Includes/footer");
        
    }
    
    /**
     * Realiza a autenticação do usuário
     * @author Lucas Moura <lmoura@universo.univates.br>
     */
    function logar(){
        //Coleta dados vindo do post
        $login = $this->input->post("login");
        $senha = $this->input->post("senha");
        //Realzia a consulta na tabela de usuários
        $this->db->where("login",$login);
        $this->db->where("senha",$senha);
        $this->db->where("ativo",true);
        $resultados = $this->db->get("usuario")->result();
        foreach ($resultados as $item){
            //Coleta informações que irrei guardar na sessão
            $infoSessao["login"] = $login;
            $infoSessao["id_usuario"] = $item->id_usuario;
            $infoSessao["nome"] = $item->nome;
            $infoSessao["logado"] = TRUE;
            //Grava em sessão
            $this->session->set_userdata($infoSessao);
            
        }
        
        //Se tiver logado vai para o Home, senão retorna para a tela de login com aviso 1
        if($this->session->userdata('logado')){
            redirect("Home");
        }else{
            redirect("Login/1");
        }
        
    }
    
    
    /**
     * Realiza o logout da tela
     * @author Lucas Moura <lmoura@universo.univates.br>
     */
    function logout(){
        //Destroi as sessões ativas para este domínio
        $this->session->sess_destroy();
        //Redireciona para a tela principal
        redirect("Home");
    }
    
    /**
     * Chama a VIEW de formulário para lembrar senha
     * @author Lucas Moura <lmoura@universo.univates.br>
     */
    function recuperar_senha(){
        $this->load->view("Includes/header");
        $erro["erro"] = "";
        $this->load->view("login/recuperar_senha",$erro);
        $this->load->view("Includes/footer");
    }
    
    /**
     * Função que gera uma senha aleatoria, troca no banco e envia por e-mail a mesma
     * @author Lucas Moura <lmoura@universo.univates.br>
    */
    function recuperar_confirmar(){
        $this->load->helper('string');
        $login = $this->input->post("login");
        $email = $this->input->post("email");
        //Monto o where
        if($login!=""){
            $this->db->where("login",$login);
        }
        if($email!=""){
            $this->db->where("email",$email);
        }
        //Se os campos foram preenchido
        if($email!="" || $login!=""){
            //Busco se tem algum usuário com estas informações
            $resultado = $this->db->get("usuario")->result();
            foreach ($resultado as $item){
                //Gero uma nova senha
                $data["senha"] = random_string('alnum', 7);
                //Altero esta senha no banco
                $this->db->where("id_usuario",$item->id_usuario);
                $this->db->update("usuario",$data);
                
                //Disparo um e-mail para o usuário com a nova senha
                
            }
            redirect("Login/2");
        }else{
            $this->load->view("Includes/header");
            $erro["erro"] = 1;
            $this->load->view("login/recuperar_senha",$erro);
            $this->load->view("Includes/footer");
        }
        
        
        
    }
    
   
}
            

        

