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
     * @param array $linhas Dados que estarão no banco de dados
     * @param type $editar Haverá botão de Editar?
     * @param type $deletar Haverá botão de deletar?
     * @param type $visualizar Haverá botão de Visualizar?
     * @author Lucas Leandro de Moura <lmoura@universo.univates.br>
     * @return html Tabela em formato HTML
     */
    protected function table($header,$linhas,$editar="",$deletar="",$visualizar=""){
        $retorno = "<table class='table'>";
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
                            $retorno.= $item["titulo"];
                        $retorno.= "</td>";
            }
            $retorno.= "        </tr>";
        }
        
        
        $retorno.= "</table>";
        
        
        
        return $retorno;
    }
        

}
            
            

        


        