<?php

//ARRAYS::pre_print($_POST);

$o_permissao = new Permissao();

$o_permissao->set_descricao($_POST['descricao']);
$o_permissao->set_ativo($_POST['status']);
$o_permissao->set_id_permissao($_POST['id_permissao']);

$o_permissao->update_permissao();


if (isset($_POST['rotas'])) {
    $o_permissao->delete_rotas_permissao();
    foreach ($_POST['rotas'] as $id_rota) {
        $o_permissao->insert_permissao_rota($_POST['id_permissao'], $id_rota);
    }
} else {
    $o_permissao->delete_rotas_permissao();
}

if (isset($_POST['tipo_usuario'])) {
    $o_permissao->delete_tipos_usuario_permissao();
    foreach ($_POST['tipo_usuario'] as $id_tipo_usuario) {
        $o_permissao->insert_permissao_usuario($_POST['id_permissao'], $id_tipo_usuario);
    }
} else {
    $o_permissao->delete_tipos_usuario_permissao();
}


APP::return_response(true, "Rota editada com sucesso");


