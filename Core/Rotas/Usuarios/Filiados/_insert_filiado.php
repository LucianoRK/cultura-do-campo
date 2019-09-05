<?php
$o_usuario       = new Usuario();
$o_telefone      = new Telefone();
$o_endereco      = new Endereco();
$o_filiado       = new Filiado();
$o_coletivo      = new Coletivo();
$o_matriz_fiscal = new MatrizFiscal();

try {
    $db = DB::get_instance();
    $db->beginTransaction();

    /**
     * Novo usuário
     */
    $nova_senha         = STRINGS::gen_password();
    $senha_hash         = SEGURANCA::password_hash($nova_senha);
    $o_usuario->set_nome($_POST['nome_completo']);
    $o_usuario->set_cpf($_POST['cpf']);
    $o_usuario->set_usuario($_POST['usuario']);
    $o_usuario->set_email($_POST['email']);
    $o_usuario->set_senha($senha_hash);
    $id_usuario_filiado = $o_usuario->insert_novo_usuario(3);

    /**
     * Telefones
     */
    if (isset($_POST['telefones']) && is_array($_POST['telefones'])) {
        foreach ($_POST['telefones'] as $value) {
            $o_telefone->setTelefone($value['telefone']);
            $o_telefone->setTipoTelefone($value['tipo_telefone']);
            $o_telefone->insert_telefone($id_usuario_filiado);
        }
    } else {
        APP::return_response(false, "Necessário informar ao menos 1 celular ou telefone fixo");
    }

    /**
     * Localização/Endereço
     */
    $id_estado    = $o_endereco->get_id_from_uf($_POST['estado']);
    $id_municipio = $o_endereco->get_id_from_nome_municipio($_POST['municipio']);
    if (!$id_estado) {
        APP::return_response(false, "Estado selecionado é inválido");
    }
    if (!$id_municipio) {
        APP::return_response(false, "Município selecionado é inválido");
    }
    $o_endereco->set_estado($id_estado);
    $o_endereco->set_municipio($id_municipio);
    $o_endereco->set_lat($_POST['lat']);
    $o_endereco->set_lng($_POST['lng']);
    $o_endereco->set_complemento($_POST['complemento']);
    $o_endereco->set_bairro($_POST['bairro']);
    $o_endereco->set_cep($_POST['cep'], false);
    $o_endereco->set_logradouro($_POST['logradouro'], false);
    $o_endereco->set_numero($_POST['numero'], false);
    $o_endereco->set_comunidade($_POST['comunidade']);
    $id_endereco = $o_endereco->insertEndereco();

    /**
     * Filiado
     */
    $o_coletivo->setIdColetivo($_POST['id_coletivo']);
    $o_filiado->setNomeFantasia($_POST['nome_fantasia']);
    $o_filiado->setRazaoSocial($_POST['razao_social']);
    $o_filiado->setCnpj($_POST['cnpj']);

    $o_filiado->setDescontoFundoRural($_POST['fundo_rural']);
    $o_filiado->setFundoCapital($_POST['fundo_capital']);
    $o_filiado->setCotaCapital($_POST['cota_capital']);

    $id_filiado = $o_filiado->insert_filiado($o_coletivo->getIdColetivo(), $id_endereco);
    $o_filiado->insert_vinculo_usuario_filiado($id_usuario_filiado, $id_filiado);

    /**
     * Insert Matriz Fiscal (sem dados)
     */
    $o_matriz_fiscal->insert_matriz_fiscal($id_filiado);

    /**
     * E-Mail com credenciais
     */
    $body     = EMAIL::body_cadastro_usuario($o_usuario->get_nome(), $o_usuario->get_usuario(), $nova_senha, 3);
    $envio_ok = EMAIL::send_mail($o_usuario->get_email(), CONFIG::$PROJECT_NAME." - Credenciais de acesso", $body);

    if ($envio_ok) {
        $db->commit();
        APP::return_response(true, "Sucesso! As credenciais foram enviadas para o e-mail informado.");
    } else {
        APP::return_response(false, "Erro: não foi possível enviar o e-mail. Cadastro cancelado.");
    }
} catch (Exception $exc) {
    $db->rollback();
}


