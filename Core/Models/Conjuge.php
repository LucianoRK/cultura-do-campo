<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conjuge
 *
 * @author Notheros
 */
class Conjuge {

    private $conn;
    private $nome;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_conjuge($id_agricultor, $id_comunhao) {
        $query = "
            INSERT INTO conjuges
            (fk_agricultor, fk_comunhao_bens, nome)
            VALUES ('{$id_agricultor}','{$id_comunhao}','{$this->getNome()}')
        ";
        $this->conn->execute($query);
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        if ($nome) {
            $this->nome = STRINGS::limpar($nome);
        } else {
            APP::return_response(false, "Informe o nome do cônjuge");
        }
    }

}
