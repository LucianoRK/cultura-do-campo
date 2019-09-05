<?php
$o_matriz_fiscal = new MatrizFiscal();
$o_filiado       = new Filiado();
try {
    $db = DB::get_instance();
    $db->beginTransaction();

    $o_matriz_fiscal->setCrt($_POST['crt']);
    $o_matriz_fiscal->setInscricaoMunicipal($_POST['inscricao_municipal']);
    $o_matriz_fiscal->setInscricaoEstadual($_POST['inscricao_estadual']);
    $o_matriz_fiscal->update_matriz_fiscal($_SESSION['id_filiado'], $_POST['cnae'], $_POST['id_regime_tributacao']);

    $o_filiado->setNomeFantasia($_POST['nome_fantasia']);
    $o_filiado->setRazaoSocial($_POST['razao_social']);
    $o_filiado->setCnpj($_POST['cnpj']);
    $o_filiado->update_nome_razao_cnpj_filiado($_SESSION['id_filiado']);

    $db->commit();
    APP::return_response(true, "Sucesso! MATRIZ FISCAL atualizada com sucesso");
} catch (Exception $exc) {
    $db->rollback();
}