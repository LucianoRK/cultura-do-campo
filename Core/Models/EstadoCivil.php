<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoCivil
 *
 * @author Notheros
 */
class EstadoCivil {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_todos_estados_civis() {
        $query = "SELECT
                    id_estado_civil,
                    estado_civil
                 FROM
                    estado_civil
                 WHERE 
                    ativo = '1' ";

        return $this->conn->fetch_all($query);
    }

}
