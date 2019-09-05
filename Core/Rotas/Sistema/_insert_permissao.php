<?php

$o_permissao = new Permissao();

try {
    $db = DB::get_instance();
    $db->beginTransaction();
    
    $o_permissao->set_descricao($_POST['descricao']);
    $id_permissao = $o_permissao->insert_permissao();
    
    if (isset($_POST['tipo_usuario']) && is_array($_POST['tipo_usuario']) && count($_POST['tipo_usuario']) > 0) {
        foreach ($_POST['tipo_usuario'] as $tipo) {
            $o_permissao->insert_permissao_usuario($id_permissao, $tipo);
        }
    } else {
        APP::return_response(false, "Selecione, ao menos, um tipo de usuário");
    }

    $db->commit();
    APP::return_response(true, "Permissão cadastrada com sucesso");
} catch (Exception $exc) {
    $db->rollback();
}

