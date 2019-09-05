<?php

//ARRAYS::pre_print($_POST);
$o_usuario = new Usuario();
$o_telefone = new Telefone();
$o_endereco = new Endereco();
$o_propriedade = new PropriedadeRural();
$o_certificacao = new Certificacao();

try {
    $db = DB::get_instance();
    $db->beginTransaction();


    /**
     * Localização/Endereço
     */
    $id_estado = $o_endereco->get_id_from_uf($_POST['estado']);
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
     * Propriedade
     */
    if (isset($_POST['id_agricultor'])) {
        $id_agricultor = $_POST['id_agricultor'];
    } else {
        if (SESSION::get_id_tipo_usuario() == 6) {
            $id_agricultor = $_SESSION['id_agricultor'];
        } else {
            APP::return_response(false, "Ocorreu um erro: Agricultor inválido");
        }
    }
    if (isset($_POST['id_tecnico'])) {
        $id_tecnico = $_POST['id_tecnico'];
    } else {
        if (SESSION::get_id_tipo_usuario() == 5) {
            $id_tecnico = $_SESSION['id_tecnico'];
        } else {
            APP::return_response(false, "Ocorreu um erro: Técnico inválido");
        }
    }


    $o_certificacao->setIdCertificacao($_POST['id_certificacao']);
    $id_propriedade = $o_propriedade->insert_propriedade_rural($id_endereco, $o_certificacao->getIdCertificacao(), $id_agricultor);

    if ($id_tecnico) {
        $o_propriedade->insert_vinculo_propriedade_tecnico($id_propriedade, $id_tecnico);
    }

    $db->commit();
    APP::return_response(true, "Propriedade cadastrada com sucesso");
} catch (Exception $exc) {
    $db->rollback();
}
