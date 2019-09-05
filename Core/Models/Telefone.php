<?php

class Telefone {

    private $conn;
    private $telefone;
    private $tipoTelefone;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_telefone($id_usuario) {
        if (is_numeric($id_usuario)) {
            $query = "
            INSERT INTO usuarios_telefones
             (
                fk_usuario, 
                tipo_telefone, 
                telefone
            )
            VALUES (
                '{$id_usuario}',
                '{$this->getTipoTelefone()}',
                '{$this->getTelefone()}'
             )";
            $this->conn->execute($query);
        } else {
            APP::return_response(false, "ID do usuário inválido. Entre em contato com o administrador.");
        }
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setTelefone($telefone) {
        if (!empty($telefone)) {
            $this->telefone = $telefone;
        } else {
            APP::return_response(false, "Número de telefone inválido");
        }
    }

    function getTipoTelefone() {
        return $this->tipoTelefone;
    }

    function setTipoTelefone($tipoTelefone) {
        if (!empty($tipoTelefone) && ($tipoTelefone == 1 || $tipoTelefone == 2)) {
            $this->tipoTelefone = $tipoTelefone;
        } else {
            APP::return_response(false, "Tipo de telefone inválido");
        }
    }

}
