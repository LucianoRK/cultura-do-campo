<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producao
 *
 * @author Notheros
 */
class Producao {

    private $conn;
    private $quantidade;
    private $periodoInicio;
    private $periodoFim;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_producao($id_agricultor, $id_produto, $id_unidade) {
        $query = "
            INSERT INTO producao
            (
                fk_agricultor, 
                fk_produto, 
                fk_unidade, 
                quantidade, 
                periodo_inicial,
                periodo_final
            )
            VALUES (
                '{$id_agricultor}',
                '{$id_produto}',
                '{$id_unidade}',
                '{$this->getQuantidade()}',
                '{$this->getPeriodoInicio()}',
                '{$this->getPeriodoFim()}'
            )
        ";
        $this->conn->execute($query);
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getPeriodoInicio() {
        return $this->periodoInicio;
    }

    function getPeriodoFim() {
        return $this->periodoFim;
    }

    function setQuantidade($quantidade) {
        if ($quantidade > 0) {
            $this->quantidade = $quantidade;
        } else {
            APP::return_response(false, "Favor informar uma quantidade válida");
        }
    }

    function setPeriodoInicio($periodoInicio) {
        $this->periodoInicio = DATE::date_to_mysql($periodoInicio);
    }

    function setPeriodoFim($periodoFim) {
        $this->periodoFim = DATE::date_to_mysql($periodoFim);
    }

}
