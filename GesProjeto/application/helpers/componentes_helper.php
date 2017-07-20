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
        
        if($campo->getNulo()=="YES"){
            $conteudo["required"] = "required";
        }
        
        return form_label($campo->getLabel_padrao())."".form_input($conteudo,$extra);
        
    }
    
    
    
}