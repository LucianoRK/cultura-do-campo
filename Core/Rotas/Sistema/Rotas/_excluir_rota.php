<?php

$o_rota = new Rota();

if (isset($_POST['id_rota']) && $_POST['id_rota']) {
    $o_rota->set_id_rota($_POST['id_rota']);
    $o_rota->desativar_rota();
    /**
     * Reconstroi o htaccess
     */
    $o_rota->rebuild_htaccess();

    APP::return_response(true, "Rota excluída com sucesso");
} else {
    APP::return_response(false, "Argumentos inválidos");
}
