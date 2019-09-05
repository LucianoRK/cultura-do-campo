<?php

//ARRAYS::pre_print($_POST);
$o_rota = new Rota();
$o_parametro = new Parametro();
$o_permissao = new Permissao();


try {
    $db = DB::get_instance();
    $db->beginTransaction();

    $o_rota->set_url($_POST['url']);
    $o_rota->set_conteudo($_POST['conteudo']);
    $o_rota->set_matriz($_POST['matriz']);
    $o_rota->set_publico($_POST['publico']);


    if (isset($_POST['params']) && !empty($_POST['params'])) {
        $expressao = $o_rota->create_regex($_POST['params']);
    } else {
        $expressao = $o_rota->create_regex();
    }

    $o_rota->set_expressao($expressao);
    $id_rota = $o_rota->insert_rota();

    if (isset($_POST['params']) && !empty($_POST['params'])) {
        foreach ($_POST['params'] as $key => $value) {
            if ($value['categoria'] == "1") {
                $o_parametro->set_parametro($value['nome']);
                $o_parametro->set_tipo($value['expressao']);
                $o_parametro->set_indice($key + 1);
                $o_parametro->insert_parametro($id_rota);
            }
        }
    }
    if ($_POST['publico'] != 1) {
        if (isset($_POST['permissoes']) && !empty($_POST['permissoes'])) {
            foreach ($_POST['permissoes'] as $key => $id_permissao) {
                $o_permissao->insert_permissao_rota($id_permissao, $id_rota);
            }
        }
    }


    $db->commit();
    $o_rota->rebuild_htaccess();
    APP::return_response(true, "Rota cadastrada com sucesso");
} catch (Exception $exc) {
    $db->rollback();
}




