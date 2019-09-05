<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Associados
 *
 * @author Notheros
 */
class Associados {

    private $conn;
    private $numeroMatricula;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_associado($id_agricultor, $id_filiado, $cota_capital_associacao) {
        $query = "
            INSERT INTO associados
            (
                fk_agricultor, 
                fk_filiado, 
                numero_matricula,
                cota_capital_associacao
            )
            VALUES (
                '{$id_agricultor}',
                '{$id_filiado}',
                '{$this->getNumeroMatricula()}',
                '{$cota_capital_associacao}'
            )
        ";
        $this->conn->execute($query);
    }

    function is_associado($id_agricultor, $id_filiado) {
        $query = "
            SELECT fk_agricultor FROM
            associados WHERE TRUE
                AND ativo = 1
                AND fk_agricultor = '{$id_agricultor}'
                AND fk_filiado = '{$id_filiado}'
        ";
        return $this->conn->fetch_attr($query, 'fk_agricultor');
    }

    function getNumeroMatricula() {
        return $this->numeroMatricula;
    }

    function setNumeroMatricula($numeroMatricula) {
        if (is_numeric($numeroMatricula)) {
            $this->numeroMatricula = STRINGS::limpar($numeroMatricula);
        } else {
            APP::return_response(FALSE, "Informe um NÚMERO DE MATRÍCULA válido");
        }
    }

}
