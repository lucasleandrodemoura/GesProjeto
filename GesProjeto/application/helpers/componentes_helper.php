<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('campo_formulario'))
{
    /**
     * Função que realiza a montagem de um campo para ser inserido em um formulário
     * Tipos aceitos: input,select,checkbox,hidden,password,radio,textarea,upload
     * @param type $campo Uma classe MODEL de Campo. new Campo();
     * @return string retorna o campo correspondente preenchido
     */
    function helperCustom_campoFormulario(Campos $campo)
    {
        $tipo_dado = $campo->getTipo_dado();
        $nulo = $campo->getNulo();
        
        $extra = "";
        //Para campos INPUT
        $conteudo = array(
                'name' => $campo->getColuna(),
                'id' => $campo->getColuna(),
                'type' => $campo->getTipo_dado(),
                'value' => $campo->getValue(),
                'maxlength' => $campo->getTamanho_maximo(),
                'placeholder' => $campo->getComentario(),
                'title' => $campo->getTabela().".".$campo->getColuna(),
                'class' => 'form-control input-sm',
              );
        //Se o campo tiver auto_increment, desabilita a edição do mesmo
        
        if($campo->getExtra()=="auto_increment"){
            $conteudo["readonly"] = "readonly";
        }
        
        if($campo->getNulo()=="NO"){
            $conteudo["required"] = "required";
        }
        
        
        
        if(sizeof($campo->getDependencia())>0){
            
            $tabela_referenciada = $campo->getDependencia()[0]->TABELA_REFERENCIADA;
            $conteudo["readonly"] = "readonly";
            $campoRetorno= form_label($campo->getLabel_padrao());
            $campoRetorno.= '<div class="input-group">';
            $campoRetorno.= form_input($conteudo,$extra);
            $campoRetorno.= '             <span class="input-group-btn">';
            $campoRetorno.= '                  <button class="btn btn-default input-sm" onclick="javascript:ConsultaPadrao(\''.$tabela_referenciada.'\',\''.$campo->getColuna().'\',\''.$campo->getColuna().'_btn\');" id="'.$campo->getColuna().'_btn" type="button">Selecionar</button>';
            $campoRetorno.= '             </span>';
            $campoRetorno.= '</div>';
            
            
            return $campoRetorno;
        }
        else if($campo->getTipo_dado()=="memo"){
            return form_label($campo->getLabel_padrao())."". form_textarea($conteudo);
        }
        else if($campo->getTipo_dado()=="boolean"){
            return form_label($campo->getLabel_padrao())."".form_dropdown($conteudo,array(0=>"Não",1=>"Sim"),$campo->getValue());
        }
        else{
        
            return form_label($campo->getLabel_padrao())."".form_input($conteudo,$extra);
        }
        
    }
    
    
    
}