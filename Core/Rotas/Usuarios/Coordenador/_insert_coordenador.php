<?php

$o_usuario = new Usuario();
$o_telefone = new Telefone();
try {
    $db = DB::get_instance();
    $db->beginTransaction();

    $nova_senha = STRINGS::gen_password();
    $senha_hash = SEGURANCA::password_hash($nova_senha);

    $o_usuario->set_nome($_POST['nome_completo']);
    $o_usuario->set_cpf($_POST['cpf']);
    $o_usuario->set_usuario($_POST['usuario']);
    $o_usuario->set_email($_POST['email']);
    $o_usuario->set_senha($senha_hash);
    $id_usuario_coordenador = $o_usuario->insert_novo_usuario(2);


    /**
     * Telefones
     */
    if (isset($_POST['telefones']) && is_array($_POST['telefones'])) {
        foreach ($_POST['telefones'] as $value) {
            $o_telefone->setTelefone($value['telefone']);
            $o_telefone->setTipoTelefone($value['tipo_telefone']);
            $o_telefone->insert_telefone($id_usuario_coordenador);
        }
    } else {
        APP::return_response(false, "Necessário informar ao menos 1 celular ou telefone fixo");
    }

    $body = EMAIL::body_cadastro_usuario($o_usuario->get_nome(), $o_usuario->get_usuario(), $nova_senha, 2);
    $envio_ok = EMAIL::send_mail($o_usuario->get_email(), CONFIG::$PROJECT_NAME . " - Credenciais de acesso", $body);

    if ($envio_ok) {
        $db->commit();
        APP::return_response(true, "Sucesso! As credenciais foram enviadas para o e-mail informado.");
    } else {
        APP::return_response(false, "Erro: não foi possível enviar o e-mail. Cadastro cancelado.");
    }
} catch (Exception $exc) {
    $db->rollback();
    //gravar o erro no banco com o handling
}