<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComunhaoBens
 *
 * @author Notheros
 */
class ComunhaoBens {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_todas_comunhao_bens() {
        $query = "SELECT
                    id_comunhao,
                    comunhao_bens
                 FROM
                    comunhao_bens
                 WHERE 
                    ativo = '1' ";

        return $this->conn->fetch_all($query);
    }

}
