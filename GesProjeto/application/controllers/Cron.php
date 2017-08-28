<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Lucas Leandro de Moura
 * Controladora que envia mensagens automáticas
 * Cria-se funções privadas e inclui a chamada dentro da função index, esta função
 * será chamada pelo servidor a cada 1 minuto
 * @date 2017-08-27
 */
class Cron extends MY_Controller {
    
    //Tela de login inicial
    function index(){
        //Chama a sua função
        $this->exemplo();
        
    }
    
    //Crie as suas funções controlando por horário que desejam que seja enviado alguma mensagem
    private function exemplo(){
        //Define o horário
        if(date("H:n")=="04:00"){
            //O que deverá fazer
            //$this->enviar_email("lmoura@universo.univates.br", "Teste", "teatea");
        }
    }
    
    
    
   
}
            

        

