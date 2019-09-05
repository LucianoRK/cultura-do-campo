<?php

$o_associado = new Associados();
$o_cargo = new AgricultoresCargos();
$o_filiado = new Filiado();


try {
    $db = DB::get_instance();
    $db->beginTransaction();



    if (!isset($_POST['id_agricultor']) || !is_numeric($_POST['id_agricultor'])) {
        APP::return_response(false, "Identificação do AGRICULTOR inválida");
    } else {
        $id_agricultor = $_POST['id_agricultor'];
    }

    if (isset($_POST['id_filiado']) && is_numeric($_POST['id_filiado'])) {
        $id_filiado = $_POST['id_filiado'];
    } else {
        if (SESSION::get_id_tipo_usuario() == 3) {
            $id_filiado = $_SESSION['id_filiado'];
        } else {
            APP::return_response(false, "Identificação do FILIADO inválida");
        }
    }

    if ($o_associado->is_associado($id_agricultor, $id_filiado)) {
        APP::return_response(false, "Este agricultor já está associado a este filiado");
    }

    $cota_capital_associacao = $o_filiado->get_cota_capital_atual($id_filiado);
    $o_associado->setNumeroMatricula($_POST['numero_matricula']);
    $o_associado->insert_associado($id_agricultor, $id_filiado, $cota_capital_associacao);


    if (isset($_POST['cargos']) && is_array($_POST['cargos'])) {
        foreach ($_POST['cargos'] as $cargo) {
            $o_cargo->setCargo($cargo['cargo']);
            $o_cargo->setDataInicio($cargo['data_inicio']);
            $o_cargo->setDataTermino($cargo['data_fim']);
            $o_cargo->setObservacoes($cargo['obs']);
            $o_cargo->insert_cargo($id_agricultor, $id_filiado);
        }
    }

    $db->commit();
    APP::return_response(true, "Associação feita com sucesso");
} catch (Exception $exc) {
    $db->rollback();
}

 
