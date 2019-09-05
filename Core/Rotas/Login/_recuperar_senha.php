<?php

$o_usuario = new Usuario();

if ($_POST['email_usuario']) {
    $email_usuario = $_POST['email_usuario'];
    $o_usuario->set_usuario($email_usuario, false);
    $usuario = $o_usuario->select_usuario_from_email_or_usuario();
    if (!empty($usuario)) {
        $email = $usuario['email'];
        $nova_senha = STRINGS::gen_password();
        $assunto = utf8_decode("Cultura do Campo - Recuperação de senha");
        $corpo = utf8_decode("Usuário: {$usuario['usuario']}<br>Nova senha: {$nova_senha}");
        $response = EMAIL::send_mail($email, $assunto, $corpo);
        if ($response) {
            $nova_senha_cripto = SEGURANCA::password_hash($nova_senha);
            $o_usuario->update_usuario_senha($usuario['id_usuario'], $nova_senha_cripto);
            APP::return_response(true, "Sucesso. A nova senha foi enviada para o e-mail: $email");
        } else {
            APP::return_response(false, "Não foi possível enviar o e-mail. Tente novamente mais tarde.");
        }
    } else {
        APP::return_response(false, "Usuário/email não cadastrado.");
    }
} else {
    APP::return_response(false, "Informe seu usuário ou e-mail cadastrado.");
}