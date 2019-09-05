<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Municipio
 *
 * @author Notheros
 */
class Municipio {

    private $conn;
    private $idMunicipio;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function selectMunicipio($id_municipio) {
        $query = "
            SELECT 
                id_municipio, nome, uf 
            FROM municipios
            WHERE id_municipio = '{$id_municipio}'
        ";
        return $this->conn->fetch($query);
    }

    function select_todos_municipios_uf($uf) {
        $query = "
            SELECT 
                id_municipio, nome
            FROM municipios
            WHERE uf = '{$uf}'
        ";
        return $this->conn->fetch_all($query);
    }

    function getIdMunicipio() {
        return $this->idMunicipio;
    }

    function setIdMunicipio($id) {
        $municipio = $this->selectMunicipio($id);
        if ($municipio) {
            $this->idMunicipio = $id;
        } else {
            APP::return_response(false, "Ocorreu um erro: MUNICÍPIO inexistente");
        }
    }

}
