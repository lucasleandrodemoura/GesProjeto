<div class="block-grid">
    <div style="WIDTH: 800px" class="content">
<?php
    print form_open($acao, array("class" => "form"));
    print ' <div class="row">';

    foreach ($campos as $item) {

        print '<div class="col-md-6 col-sm-6 col-xs-6">';
        //Define a label
        print form_label($item->rotulo, "label_" . $item->codigo_campo);
        //Caracteristicas do campo
        $data = array(
            'class' => 'form-control',
            'name' => trim($item->coluna),
            'id' => $item->codigo_campo,
            'type' => $item->tipo_valor,
            'placeholder' => $item->rotulo,
            'value' => ''
        );
        if ($dados != "") {
            $data["value"] = $dados[trim($item->coluna)];
        }
        if ($item->obrigatorio) {
            $data["required"] = "required";
        }

        //Desenha o campo
        if ($item->tipo_campo == 1) {
            print form_input($data);
        } else if ($item->tipo_campo == 2) {
            print form_textarea($data);
        } else if ($item->tipo_campo == 3) {
            //Se for um campo booleano o mesmo acaba montando um campo Sim ou Não
            if ($item->tipo_valor == "boolean") {
                $lista = array('t' => "Sim", 'f' => "Não");
            } else {

                $this->db->select($item->coluna_dependencia . " as id," . $item->exibicao_dependencia . " as label");
                $this->db->order_by($item->exibicao_dependencia);
                $lista[""] = "";
                foreach ($this->db->get($item->tabela_dependencia)->result() as $valores) {
                    $lista[$valores->id] = $valores->label;
                }
            }

            print form_dropdown($data, $lista, $data["value"]);
        }

        print '</div>';
    }

    print form_submit("btn_salvar", "Salvar", "class='btn btn-success'");
    print "</div>";
    print form_close();
    ?>
        </div>
</div>