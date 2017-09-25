<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
if ( ! function_exists('L_progress_bar'))
{

        /**
         * Retorna uma barra de progresso para ser utilizada quando necessário 
         * @author Lucas Leandro de Moura
         * @data 2017-09-12
         * @param float $valor O valor que deverá ser representado pela barra de progresso
         * @param class $cor Utilizar padrões do bootstrap para cores: <br>progress-bar-success
           .progress-bar-info<br>
           .progress-bar-warning<br>
           .progress-bar-danger<br>
         * @return html Retorna a barra de progresso em HTML
         */
	function L_progress_bar($valor,$cor = "progress-bar-info")
	{
            return '<div class="progress">
                        <div class="progress-bar '.$cor.'" role="progressbar" aria-valuenow="'.$valor.'"
                        aria-valuemin="0" aria-valuemax="100" style="width:'.$valor.'%">
                          '.$valor.'%
                        </div>
                    </div>';
        }
      
}


if ( ! function_exists('L_label_data'))
{

        /**
         * Formata a data conoforme desejado
         * @author Lucas Leandro de Moura
         * @param timestamp $data Data no formato timestamp
         * @param type $formato_desejado O formato desejado da saída
         * @return string Label contendo a data formatada
         */
	function L_label_data($data,$formato_desejado)
	{
            return date($formato_desejado, strtotime($data));
        }
      
}




if ( ! function_exists('L_boolean'))
{

        /**
         * Formata valores booleanos
         * @author Lucas Leandro de Moura
         * @return string Label Contendo o valor formatado
         */
	function L_boolean($data)
	{
            $retorno = "Não";
            if($data=="t"){
                $retorno = "Sim";
            }
            return $retorno;
        }
      
}

if ( ! function_exists('L_Editar'))
{
/**
         * Cria um link de edição para ser utilizado nas tables
         * @author Lucas Leandro de Moura
         * @param array $indice Array de índices contendo o campo que deverá conter no link para edição<br>
         * EX: array(array("codigo"=>1),array("cliente"=>2))
         * @param String $caminho Controladora responsável por montar a tela de edição
         */
	function L_Editar($indice,$caminho)
	{
            $link = base_url()."".$caminho."?";
            foreach ($indice as $v){
                foreach($v as $campos=>$valor){
                    $link.=$campos."=".$valor;
                }
            }
            
            return "<a class='btn btn-success small' title='Editar' href=javascript:Novo('".$link."');>"
                    . "<i class='fa fa-edit'></i>"
                 . "</a>";
        }
}


if ( ! function_exists('L_Abrir'))
{
/**
         * Retorna um link com a pasta abrir
         * @author Lucas Leandro de Moura
         * @param array $indice Array de índices contendo o campo que deverá conter no link para edição<br>
         * EX: array(array("codigo"=>1),array("cliente"=>2))
         * @param String $caminho Controladora responsável
         */
	function L_Abrir($indice,$caminho)
	{
            $link = base_url()."".$caminho."?";
            foreach ($indice as $v){
                foreach($v as $campos=>$valor){
                    $link.=$campos."=".$valor;
                }
            }
            
            return "<a class='btn btn-primary small' title='Abrir o projeto' href='".$link."'>"
                    . "<i class='fa fa-folder-open'></i>"
                 . "</a>";
        }
}

if ( ! function_exists('L_Deletar'))
{

        /**
         * Cria um link de exclusão para ser utilizado nas tables
         * @author Lucas Leandro de Moura
         * @param array $indice Array de índices contendo o campo que deverá conter no link para exclusão<br>
         * EX: array(array("codigo"=>1),array("cliente"=>2))
         * @param String $caminho Controladora responsável por realizar a exclusão do registro
         */
	function L_Deletar($indice,$caminho)
	{
            $link = base_url()."".$caminho."?";
            foreach ($indice as $v){
                foreach($v as $campos=>$valor){
                    $link.=$campos."=".$valor;
                }
            }
            
            return "<a class='btn btn-danger small' title='Excluir' href='".$link."'>"
                    . "<i class='fa fa-trash'></i>"
                 . "</a>";
        }
        
        
      
}
