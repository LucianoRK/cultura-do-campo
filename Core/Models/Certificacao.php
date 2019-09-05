<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Certificacao
 *
 * @author Notheros
 */
class Certificacao {

    private $conn;
    private $idCertificacao;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_todas_certificacoes() {
        $query = "
            SELECT 
                id_certificacao,
                descricao
            FROM certificacoes_organicas
            WHERE TRUE
                AND ativo = 1
        ";
        return $this->conn->fetch_all($query);
    }

    function select_certificacao($id_certificacao) {
        $query = "
         SELECT 
                id_certificacao,
                descricao
            FROM certificacoes_organicas
            WHERE TRUE
                AND ativo = 1
                AND id_certificacao = '{$id_certificacao}'";
        return $this->conn->fetch($query);
    }

    function getIdCertificacao() {
        return $this->idCertificacao;
    }

    function setIdCertificacao($idCertificacao) {
        $certificacao = $this->select_certificacao($idCertificacao);
        if ($certificacao) {
            $this->idCertificacao = $idCertificacao;
        } else {
            APP::return_response(false, "A certificação escolhida é inválida");
        }
    }

}
