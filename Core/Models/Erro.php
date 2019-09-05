<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Erro
 *
 * @author Notheros
 */
class Erro {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_erro($arquivo, $tipo, $mensagem, $linha) {
        $query = "
            INSERT INTO
            erros
            (arquivo, tipo, mensagem, linha)
            VALUES (
                '{$arquivo}',
                '{$tipo}',
                '{$mensagem}',
                '{$linha}'
            )
        ";
        $this->conn->execute($query);
    }

}
