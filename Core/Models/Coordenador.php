<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coordenador
 *
 * @author Notheros
 */
class Coordenador {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_coordenadores() {
        $query = "
            SELECT
                id_usuario, nome, cpf, email
            FROM
                usuarios
            WHERE TRUE
                AND fk_tipo_usuario = 2
                AND ativo = 1
        ";
        return $this->conn->fetch_all($query);
    }

    function select_ids_tecnicos_coordenador() {
        $id_usuario_coordenador = SESSION::get_id_usuario();
        $id_tipo_usuario = SESSION::get_id_tipo_usuario();
        if ($id_tipo_usuario == 3) {
            $query = "
                SELECT
                    GROUP_CONCAT(DISTINCT(fk_usuario)) as ids
                FROM
                    tecnicos
                INNER JOIN usuarios ON fk_usuario = id_usuario
                WHERE TRUE
                    AND fk_tipo_usuario = 5
                    AND ativo = 1
                    AND fk_usuario_coordenador = '{$id_usuario_coordenador}'
            ";
            $tecnicos = $this->conn->fetch($query);
            return $tecnicos['ids'];
        } else {
            return "-1";
        }
    }

}
