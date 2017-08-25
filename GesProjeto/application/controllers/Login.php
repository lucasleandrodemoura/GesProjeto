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
        $this->db->where("tentativa_login<=3");
        $this->db->where("ativo",true);
        $resultados = $this->db->get("usuario")->result();
        foreach ($resultados as $item){
            //Coleta informações que irrei guardar na sessão
            $infoSessao["login"] = $login;
            $infoSessao["id_usuario"] = $item->id_usuario;
            $infoSessao["nome"] = $item->nome;
            $infoSessao["logado"] = TRUE;
            
            //Reseta as tentativas de login
            $data["tentativa_login"] = 0;
            $this->db->where("id_usuario",$item->id_usuario);
            $this->db->update("usuario",$contagem);
            
            //Grava em sessão
            $this->session->set_userdata($infoSessao);
            
        }
        
        //Se tiver logado vai para o Home, senão retorna para a tela de login com aviso 1
        if($this->session->userdata('logado')){
            redirect("Home");
        }else{
            //Caso o usuário conseguiu acertar o login, contabiliza uma tentativa de login
            //No momento que chegar em 3 o mesmo irá resetar a senha
            $this->db->where("login",$login);
            $this->db->where("ativo",true);
            $login_acerto = $this->db->get("usuario")->result();
            foreach($login_acerto as $item ){
                //Incrementa mais uma tentativa para este login
                $contagem["tentativa_login"] = $item->tentativa_login++;
                $this->db->where("id_usuario",$item->id_usuario);
                $this->db->update("usuario",$contagem);
                //Chegando acima de 3 tentativas manda recuperar a senha
               if($contagem["tentativa_login"]>3){
                 redirect("Login/recuperar_senha/2");
               }
                
            }
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
    function recuperar_senha($cod_erro=""){
        $this->load->view("Includes/header");
        $erro["erro"] = $cod_erro;
        $this->load->view("login/recuperar_senha",$erro);
        $this->load->view("Includes/footer");
    }
    
    /**
     * Função que gera uma senha aleatoria, troca no banco e envia por e-mail a mesma
     * @author Lucas Moura <lmoura@universo.univates.br>
    */
    function recuperar_confirmar(){
        $this->load->helper('string');
        $login = $this->input->get("login");
        $email = $this->input->get("email");
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
                $data["tentativa_login"] = 0;
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
    
    
    /**
     * Abre a tela de cadastro de usuários
     */
    function cadastro(){
        $this->load->view("Includes/header");
        $data["erro"] = "";
        $this->load->view("login/cadastro",$data);
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
            $this->load->view("login/cadastro",$erro);
            $this->load->view("Includes/footer");
        }else{
            //Faz a inclusão
            $this->db->insert("usuario",$data);
            redirect("Login/3");
        }
    }
    
   
}
            

        

