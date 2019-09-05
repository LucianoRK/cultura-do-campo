<?php

$o_entrega = new Entrega();
$o_endereco = new Endereco();

$o_entrega->set_id_entrega($_POST['id_entrega']);
$array_pendentes = $o_entrega->select_entrega();
$array_clientes = $o_entrega->select_clientes_entrega();


/**
 * Endereço da origem (produtor)
 */
$endereco = $o_endereco->select_enderecos_usuarios(SESSION::get_id_usuario());

foreach ($array_clientes as $key => $value) {
    $value['endereco'] = $o_endereco->select_enderecos_usuarios($value['id_usuario']);
    $array_clientes[$key] = $value;
}

$response['origem'] = $endereco;
$response['clientes'] = $array_clientes;

echo json_encode($response);