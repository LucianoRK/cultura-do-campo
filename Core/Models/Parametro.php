<?php

class Parametro {

    private $parametro;
    private $tipo;
    private $indice;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_parametros($id_rota) {
        $query = "
            SELECT 
                indice, parametro AS nome, tipo AS expressao
            FROM rotas_parametros
            WHERE fk_rota = '{$id_rota}'
        ";
        return $this->conn->fetch_all($query);
    }

    function insert_parametro($id_rota) {
        $query = "
            INSERT INTO rotas_parametros
            (fk_rota, parametro, tipo, indice)
            VALUES 
            (
                '{$id_rota}',
                '{$this->get_parametro()}',
                '{$this->get_tipo()}',
                '{$this->get_indice()}'
            )
        ";
        $this->conn->execute($query);
    }

    function delete_parametros_rota($id_rota) {
        $query = "
            DELETE FROM rotas_parametros WHERE fk_rota = '{$id_rota}'
        ";
        $this->conn->execute($query);
    }

    function get_parametro() {
        return $this->parametro;
    }

    function get_tipo() {
        return $this->tipo;
    }

    function get_indice() {
        return $this->indice;
    }

    function set_parametro($parametro) {
        $this->parametro = $parametro;
    }

    function set_tipo($tipo) {
        $this->tipo = $tipo;
    }

    function set_indice($indice) {
        $this->indice = $indice;
    }

}
