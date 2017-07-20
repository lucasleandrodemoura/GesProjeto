<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controladora principal
 * @author Lucas Leandro de Moura <lucasleandrodemoura@gmail.com:
 * @data 2017-07-20
 */
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
        
        /**
         * Alimenta o titulo do controlador
         * @param type $titulo
         */
        function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        /**
         * Alimenta a tabela que ser[a usada no sistema
         * @param type $tabela
         */
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
            $cadastros = new Cadastros();
            $info["action"] = $this->tabela."/submit";
            $info["titulo"] = "Cadastro de ".$this->titulo;
            $info["voltar"] = $this->tabela;
            if(sizeof($indice)>0){
                $link = "";
                foreach ($indice as $key=>$value){
                    if($link!=""){
                        $link.="&";
                    }
                    $link.=$key."=".$value;
                }
                $info["botao_editar"] = TRUE;
                $info["action"] = $this->tabela."/submit?".$link;
                $info["botao_excluir"] = FALSE;
                $info["botao_inserir"] = FALSE;
                $cadastros->setEditar($indice);
            }
            else{
                $info["botao_editar"] = FALSE;
                $info["botao_excluir"] = FALSE;
                $info["botao_inserir"] = TRUE;
            }
            
       
            
            
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
            
            $info = $this->camposCadastro($indice);
            
            
            $this->load->view("Includes/header_nav");
            $menus = new Menus();
            $dataMenu["menus"] = $menus->getMenus();
            $this->load->view("Includes/menu",$dataMenu);
            $this->load->view("record",$info);
            $this->load->view("Includes/footer");
        }
        
        /**
         * Controlador responsável em submter formulários
         * @author Lucas Leandro de Moura
         */
        public function submit(){
            $this->autentica();
            $filtros = $this->input->get();
            
            
               //Realiza a rotina de gravação no banco
                $campos_formulario = $this->input->post();
                //Pega apenas o que for campos e monta nos registros
                foreach($campos_formulario as $key=>$value){
                   if($key!="btn_voltar"
                           && $key!="btn_editar"
                           && $key!="btn_excluir"
                           && $key!="btn_inserir"){
                        $data[$key] = strtoupper($this->input->post($key));
                   }
                }
                
                
                if(sizeof($filtros)>0){
                    
                    $this->before_update();
                    foreach($filtros as $key_filtro=>$value_filtro){
                        $this->db->where($key_filtro,$value_filtro);
                    }
                    $this->db->update($this->prefixo."".$this->tabela,$data);
                    $this->after_update();
                    
                }else{
                    
                    $this->before_insert();
                    $this->db->insert($this->prefixo."".$this->tabela,$data);
                    $this->after_insert();
                }
                
                redirect($this->tabela);
               
        }
        
        /**
         * Função para instruções depois de inclusões
         * @author Lucas Leandro de Moura
         */
        protected function after_insert(){
            
        }
        
        /**
         * Função para instruções antes de inclusões
         */
        protected function before_insert(){
            
        }

        protected function before_update() {

        }

        protected function after_update() {

        }

}
            
            

        


        