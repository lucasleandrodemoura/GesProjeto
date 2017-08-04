<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controladora principal
 * @author Lucas Leandro de Moura <lucasleandrodemoura@gmail.com:
 * @data 2017-07-20
 */
class MY_Controller extends CI_Controller {

    protected $prefixo = "";
    protected $tabela = "";
    protected $titulo = "";
    protected $redirect = "";
    //Array com botões = array('icon'=>,'titulo'=>,'link'=>)
    private $addBotoes = FALSE;
    protected $box = FALSE;
    protected $info;
    protected $dataMenu;
    private $botaoVoltar = "";
    private $src;
    private $where;

    /**
         * Confere a autenticação
         */
	protected function autentica(){
            if($this->session->userdata('logado')){
                $this->prefixo = $this->session->userdata('prefixo');
            }else{
                redirect("Login");
            }
        }
        /**
         * Adiciona um botão de ação na list
         * @param type $icone = Icone que o botão terá, utilizar padrões fa
         * @param type $titulo = Titulo que terá ao parar o mouse sobre
         * @param type $link = Controler que será enviado ao clicar sobre
         */
        function addBotaoAcao($icone,$titulo,$link){
          $this->addBotoes[] = array("icon"=>$icone,"title"=>$titulo,"link"=>$link);
        }
        
        function setBotaoVoltar($botaoVoltar) {
            $this->botaoVoltar = $botaoVoltar;
        }
        
        /**
         * Seta o caminho de um formulário
         * @param type $src
         */
        function setSrc($src) {
            $this->src = $src;
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
        
        
        protected function setWhere($key,$operador,$valor){
            $this->where[] = array($key,$operador,$valor);
        }
        
        /**
         * Função responsável por carregar o padrão de informações para as telas padrões de exibição
         */
        protected function indexBase(){
            $this->autentica();
            
            $tabela = $this->prefixo."".$this->tabela;
            
            
            $this->info["novo"] = $this->tabela."/cadastro";
            $this->info["src"] = $this->src;
            $this->info["titulo"] = $this->titulo;
            $this->info["editar"] = TRUE;
            $this->info["seleciona"] = FALSE;
            $this->info["acoes"] = $this->addBotoes;
            $this->info["botaoVoltar"] = $this->botaoVoltar;
            
            
            $mbrowser = new Cadastros();
            if(is_array($this->where)){
                foreach($this->where as $whereArray){
                    
                    $mbrowser->setWhere($whereArray[0],$whereArray[1],$whereArray[2]);
                    
                }
            }
            $this->info["dados"] = $mbrowser->mBrowser($tabela);
            $menus = new Menus();
            $this->dataMenu["menus"] = $menus->getMenus();
        }
                
        /**
         * Página principal do Master, onde irá exibir todas as empresas cadastradas e suas configurações de bancos
         */
	public function index()
	{
            $this->setSrc($this->tabela);
            $this->indexBase();
            
            if($this->box){
                $this->load->view("Includes/header");
            }else{
                
                $this->load->view("Includes/header_nav");
                $this->load->view("Includes/menu",$this->dataMenu);
            }
            $this->load->view("list",$this->info);
            $this->load->view("Includes/footer");
            
            
	}
     
        /**
         * Retorna todos os campos necessários para um cadastro de empresa
         * @return \Campos Array contendo todos os campos necessários para o cadastro ou edição
         */
        private function camposCadastro($indice=null){
            $cadastros = new Cadastros();
            $this->info["action"] = $this->tabela."/submit";
            $this->info["titulo"] = "Cadastro de ".$this->titulo;
            $this->info["voltar"] = $this->tabela;
            if(sizeof($indice)>0){
                $link = "";
                foreach ($indice as $key=>$value){
                    if($link!=""){
                        $link.="&";
                    }
                    $link.=$key."=".$value;
                }
                $this->info["botao_editar"] = TRUE;
                $this->info["action"] = $this->tabela."/submit?".$link;
                $this->info["botao_excluir"] = TRUE;
                $this->info["botao_inserir"] = FALSE;
                $cadastros->setEditar($indice);
            }
            else{
                $this->info["botao_editar"] = FALSE;
                $this->info["botao_excluir"] = FALSE;
                $this->info["botao_inserir"] = TRUE;
            }
            
       
            
            
            $this->info["dados"] = $cadastros->xCadastro($this->prefixo."".$this->tabela);
            
            
            return $this->info;
        }
        
        /**
         * Control que realizar o cadastro de empresas novas no sistema
         * @param type $indice Caso for edição passa a ID de filtro
         */
        public function cadastro(){
            
            $this->autentica();
            $tabela = $this->prefixo."".$this->tabela;
            $indice = $this->input->get();
            $link = "";
            //Se for modo ediçao
            if(sizeof($indice)>0){
                
                    foreach ($indice as $key=>$value){
                        if($link!=""){
                            $link.="&";
                        }
                        $link.=$key."=".$value;
                }
            }
            $this->info = $this->camposCadastro($indice);
            $this->info["key"] = $link;
            
            $this->load->view("Includes/header");
            $this->load->view("record",$this->info);
            $this->load->view("Includes/footer");
        }
        
        
        public function excluir(){
            
            $this->autentica();
            $parametros = $this->input->get();
            foreach($parametros as $chave=>$valor){
                $this->db->where($chave,$valor);
            }

            $this->db->delete($this->prefixo."".$this->tabela);
            $erro = $this->db->error();
            if($erro["code"]>0){
                if($erro["code"]==1451){
                   $dados["mensagem"] = "Este registro esta sendo utilizado em outro cadastro, não sendo possível a sua exclusão!";
                }else{
                   $dados["mensagem"] = $erro["code"].": Não foi possível realizar exclusão deste registro! ";
                }
            }else {
                $dados["mensagem"] = "Registro excluído com sucesso";
            }
         
         
            $this->load->view("Includes/header");
            $this->load->view("mensagem",$dados);
            $this->load->view("Includes/footer");
        }
        
        
        /**
         * Controlador responsável em submeter formulários
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
                if($this->redirect!=""){
                    redirect($this->redirect);
                }
               
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
            
            

        


        