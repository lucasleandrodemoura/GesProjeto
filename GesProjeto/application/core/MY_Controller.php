<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controladora principal, colocar todas as funções comuns das controladoras para herdar nas controlaras principais
 * @author Lucas Leandro de Moura <lucasleandrodemoura@gmail.com:
 * @data 2017-08-20
 */
class MY_Controller extends CI_Controller {
    protected $codigo_usuario; 
    /**
     *Variável que contém o cabecalho da table
     * @var array 
     */
    protected $cabecalho = array();
    /**
     *Linhas da tabela
     * @var array
     */
    protected $linhas = array();
    /**
     *Qual o nome da tabela no banco de dados, que se trata este controlador
     * @var String
     */
    protected $tabela = "";

    /**
     *Define os dados de uma grid
     * @var array Dados da tabela 
     */
    protected $dados = array();

    /**
     *DataSource para realizar upgrade ou insert
     * @var array() Grade de informações
     */
    protected $data = array();
    
    /**
     * Ação ao submeter o formulário padrão
     * @var String 
     */
    protected $acao = "";
    

    /**
     *Define a View de cadastro padrão
     * @var String 
     */
    protected $view_cadastro_padrao = "default_cadastro";
    
    /**
     *Nome da tela
     * @var String 
     */
    protected $titulo = "";

    /**
     * Função responsável em realizar a checagem se existe uma sessão ativa
     * Esta função poder ser utilizado nos controladores que precisam de controle de acesso
     */
    protected function autentica(){
        if($this->session->userdata('logado')){
            $this->codigo_usuario = $this->session->userdata('id_usuario');
        }else{
            redirect("Login");
        }
       
    }
    
    /**
     * Função que gera um PDF
     * @author Lucas Leandro de Moura <lmoura@universo.univates.br>
     * @param String $nome Nome do arquivo
     * @param html $conteudo Conteúdo que terá no PDF
     */
    protected function geraPDF($nome,$conteudo){
        $this->autentica();
        require_once '/var/www/gestaoprojetos/Includes/mpdf/vendor/autoload.php';
        $mpdf = new mPDF();
        $mpdf->WriteHTML($conteudo);
        $mpdf->Output();
    }
    
    /**
     * Função que envia e-mails para um destinatário
     * @link https://www.codeigniter.com/user_guide/libraries/email.html Referência
     * @author Lucas Leandro de Moura <lmoura@universo.univates.br>
     * @see 2017
     * @example $this->enviar_email("destino@destino.com.br", "Assunto", "Mensagem de corpo");
     * @param String $para Para quem será enviado o e-mail
     * @param String $assunto Assunto da mensagem
     * @param String $mensagem Mensagem que será enviada
     * @return boolean Retorna true se o e-mail foi enviado com sucesso
     */
    protected function enviar_email($para,$assunto,$mensagem){
        //Configurações do servidor de envio de e-mails
        $this->load->library('email');
        $config["protocol"] = "smtp";
        $config["smtp_host"] = "smtp.googlemail.com";
        $config["smtp_user"] = "projetostccunivates@gmail.com";
        $config["smtp_pass"] = "projetostcc";
        $config["smtp_port"] = "465";
        $config["mailtype"] = "html";
        $config["smtp_crypto"] = "ssl";
        $this->email->initialize($config);
        
        //Configuração de envio de mensagens
        $this->email->from('projetostccunivates@gmail.com');
        $this->email->to($para);
        $this->email->subject($assunto);
        $this->email->set_newline("\r\n");
        $this->email->message($mensagem);

        return $this->email->send();
    }
    
    /**
     * Função que retorna uma DataTable preenchida
     * @param array $header Cabecalho da tabela
     * @param array $linhas Dados que estarão no banco de dados array[]["dados"] = array("","","","")
     * @param type $editar Haverá botão de Editar?
     * @param type $deletar Haverá botão de deletar?
     * @param type $visualizar Haverá botão de Visualizar?
     * @author Lucas Leandro de Moura <lmoura@universo.univates.br>
     * @return html Tabela em formato HTML
     */
    protected function table($header,$linhas,$editar="",$deletar="",$visualizar=""){
        $retorno = "<table class='table table-striped table-hover table-bordered'>";
        $retorno.= "    <thread>";
        $retorno.= "        <tr>";
        
        //Adicionando o cabecalho da tabela
        foreach($header as $item){
                    $retorno.= "<th>";
                        $retorno.= $item["titulo"];
                    $retorno.= "</th>";
        }
        $retorno.= "        </tr>";
        $retorno.= "    </thread>";
 
        //Adicionando as linhas da tabela
        foreach($linhas as $registro){
            $retorno.= "        <tr>";
            foreach($registro["dados"] as $item){
                        $retorno.= "<td>";
                            $retorno.= $item;
                        $retorno.= "</td>";
            }
            $retorno.= "        </tr>";
        }
        
        
        $retorno.= "</table>";
        
        
        
        return $retorno;
    }
    
    /**
     * 
     * @param String $tabela Informe a tabela
     */
    function setTabela(String $tabela) {
        $this->tabela = $tabela;
    }

      
    function setCabecalho($cabecalho) {
        $this->cabecalho = $cabecalho;
    }

    function setLinhas($linhas) {
        $this->linhas = $linhas;
    }
    
    function setTitulo(String $titulo) {
        $this->titulo = $titulo;
    }

    
        
    function index(){
        $this->autentica();
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
        
        $dados["tabela"] =$this->table($this->cabecalho, $this->linhas);
        $dados["titulo"] = $this->titulo;
        
        $this->load->view("default_list",$dados);
        $this->load->view("Includes/footer");
    }
    
    function setDados(array $dados) {
        $this->dados = $dados;
    }
    
    
    function setAcao(String $acao) {
        $this->acao = $acao;
    }
    
    /*
     * Define Componentes no dataSource
     * @author Lucas Leandro de Moura
     */
    function setData(array $data) {
         $this->data = $data;
    }

    
            
    /**
     * Tela padrão de cadastro
     * @author Lucas Leandro de Moura
     */
    function cadastro(){
        $this->autentica();
        $this->load->view("Includes/header");
        $this->load->view("Includes/header_nav");
        
        $dados["tabela"] =$this->table($this->cabecalho, $this->linhas);
        $dados["titulo"] = $this->titulo;
        $dados["acao"] = $this->acao;
        
        $this->db->where("tabela",$this->tabela);
        $this->db->where("exibir_cadastro",true);
        $this->db->order_by("ordenacao ASC");
        $dados["campos"] = $this->db->get("estruturador")->result();
        
        //Define os dados do formulário, caso for edição
        if(sizeof($this->dados)==1){
            $dados["dados"] = (array) $this->dados[0];
            
        }else{
            $dados["dados"] = "";
        }
   
        $this->load->view($this->view_cadastro_padrao,$dados);
        $this->load->view("Includes/footer");
    }
    
    /**
     * Função que realiza um cadastro genérico
     * @author Lucas Leandro de Moura
     */
    function cadastrar(){
        $this->autentica();
        $infoTela = $this->input->post();
       
        
        foreach($infoTela as $key=>$valor){
            if($key!="btn_salvar"){
                $this->data[$key] = $valor;
            }
        }
        $this->db->insert($this->tabela,$this->data);
    }
    
    function getView_cadastro_padrao(): String {
        return $this->view_cadastro_padrao;
    }

    /**
     * Define uma nova view de cadastro padrão
     * @author Lucas Moura<lmoura@universo.univates.br>
     * @param String $view_cadastro_padrao
     */
    function setView_cadastro_padrao(String $view_cadastro_padrao) {
        $this->view_cadastro_padrao = $view_cadastro_padrao;
    }


    
        

}
            
            

        


        