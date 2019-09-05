<?php


class Estado {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_todos_estados() {
        $query = "SELECT nome, uf FROM estados";
        return $this->conn->fetch_all($query);
    }

}
