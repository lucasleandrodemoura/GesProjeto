<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    private $prefixo = "";
    protected $tabela = "";
    protected $titulo = "";
    /**
         * Confere a autenticação
         */
	private function autentica(){
            if($this->session->userdata('logado')){
                $this->prefixo = $this->session->userdata('prefixo');
            }else{
                redirect("Login");
            }
        }
        
        function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

                
        function setTabela($tabela) {
            $this->tabela = $tabela;
        }

                
        /**
         * Página principal do Master, onde irá exibir todas as empresas cadastradas e suas configurações de bancos
         */
	public function index()
	{
            $this->autentica();
            
            $tabela = $this->prefixo."".$this->tabela;
            
            
            $info["novo"] = $this->tabela."/cadastro";
            $info["src"] = $this->tabela;
            $info["titulo"] = $this->titulo;
            
            
            $mbrowser = new Cadastros();
            $info["dados"] = $mbrowser->mBrowser($tabela);
            
            
            $menus = new Menus();
            $dataMenu["menus"] = $menus->getMenus();
            
            $this->load->view("Includes/header_nav");
            $this->load->view("Includes/menu",$dataMenu);
            $this->load->view("list",$info);
            $this->load->view("Includes/footer");
            
            
	}
        
        /**
         * Retorna todos os campos necessários para um cadastro de empresa
         * @return \Campos Array contendo todos os campos necessários para o cadastro ou edição
         */
        private function camposCadastro($indice=null){
            
            $info["action"] = $this->tabela."/submit";
            $info["titulo"] = "Cadastro de ".$this->titulo;
            $info["voltar"] = $this->tabela;
            if($indice){
                $info["botao_editar"] = TRUE;
                $info["action"] = $this->tabela."/submit/".$indice;
                $info["botao_excluir"] = FALSE;
                $info["botao_inserir"] = FALSE;
            }
            else{
                $info["botao_editar"] = FALSE;
                $info["botao_excluir"] = FALSE;
                $info["botao_inserir"] = TRUE;
            }
            
       
            
            $cadastros = new Cadastros();
            print_r($indice);
            $cadastros->setEditar($indice);
            
            $info["dados"] = $cadastros->xCadastro($this->prefixo."".$this->tabela);
            
            
            return $info;
        }
        
        /**
         * Control que realizar o cadastro de empresas novas no sistema
         * @param type $indice Caso for edição passa a ID de filtro
         */
        public function cadastro(){
            
            $this->autentica();
            $tabela = $this->prefixo."".$this->tabela;
            $indice = $this->input->get();
            print_r($indice);
            die();
            $info = $this->camposCadastro($indice);
            
            
            $this->load->view("Includes/header_nav");
            $menus = new Menus();
            $dataMenu["menus"] = $menus->getMenus();
            $this->load->view("Includes/menu",$dataMenu);
            $this->load->view("record",$info);
            $this->load->view("Includes/footer");
        }
        
        
        
        public function submit($codigo_caminhoes=null){
            $this->autentica();
            $this->load->library('form_validation');
            
            //Validando campos
            $this->form_validation->set_rules('placa', 'Placa', 'required');
            $this->form_validation->set_rules('descricao', 'Descrição', 'required');
            $this->form_validation->set_rules('capacidade', 'Capacidade', 'required');
            $this->form_validation->set_message('rule', 'Error Message');
            
            if ($this->form_validation->run() == FALSE){
                
                $info = $this->camposCadastro();
                $this->load->view("Includes/header_nav");
                $menus = new Menus();
                $dataMenu["menus"] = $menus->getMenus();
                $this->load->view("Includes/menu",$dataMenu);
                $this->load->view("record",$info);
                $this->load->view("Includes/footer");
            }
            else{
               //Realiza a rotina de gravação no banco
                $data["placa"] = $this->input->post("placa");
                $data["descricao"] = $this->input->post("descricao");
                $data["capacidade"] = $this->input->post("capacidade");
                $data["ativo"] = $this->input->post("ativo");
                $data["codigo_sistema"] = $this->input->post("codigo_sistema");
                
                if($codigo_caminhoes){
                    $this->db->update($this->prefixo."caminhoes",$data,"codigo_caminhoes = ".$codigo_caminhoes);
                    redirect("caminhoes");
                }else{
                    $this->db->insert($this->prefixo."caminhoes",$data);
                    redirect("caminhoes");
                }
                
            }
               
        }
        
        }
            
            

        


        