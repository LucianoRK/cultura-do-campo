<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coletivo
 *
 * @author Notheros
 */
class Coletivo {

    private $conn;
    private $idColetivo;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_todos_coletivos() {
        $query = "
            SELECT 
                id_coletivo,
                descricao
            FROM coletivos
            WHERE TRUE
                AND ativo = 1
        ";
        return $this->conn->fetch_all($query);
    }

    function select_coletivo($id_coletivo) {
        $query = "
            SELECT
                descricao
            FROM coletivos
            WHERE TRUE
                AND id_coletivo = '{$id_coletivo}'
                AND ativo = 1
        ";
        return $this->conn->fetch($query);
    }

    function getIdColetivo() {
        return $this->idColetivo;
    }

    function setIdColetivo($idColetivo) {
        $coletivo = $this->select_coletivo($idColetivo);
        if ($coletivo) {
            $this->idColetivo = $idColetivo;
        } else {
            APP::return_response(false, "Coletivo selecionado é inválido");
        }
    }

}
