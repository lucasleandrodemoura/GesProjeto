 
      function ConsultaPadrao(key,campo_retorno,btn_retorno,base_url="http://www.suppry.com.br/fezinha/"){
            top.window.jConsulta = new top.window.Janela("consulta_padrao",base_url+"consultapadrao?ref="+key,"Consulta Padrão",1024,500);
            top.window.jConsulta.seleciona = function (codigo, descricao) {
                document.getElementById(campo_retorno).value = codigo;
                document.getElementById(btn_retorno).innerHTML = descricao;
                top.window.jConsulta.close();
           }
            top.window.jConsulta.autoSize();
            top.window.jConsulta.show();            
      }
      function Cadastros(src){
            top.window.jCadastros = new top.window.Janela("janela",src,"Cadastros",800,500);
            
            top.window.jCadastros.autoCloseMaint("form_record_default");
            top.window.jCadastros.onCloseRefresh(window);
            top.window.jCadastros.show();            
      }