<?php

class FornecedorTelefone {

    private $conn;
    private $telefone;
    private $tipoTelefone;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_telefone($fk_fornecedor) {
        if (is_numeric($fk_fornecedor)) {
            $query = "
            INSERT INTO fornecedores_telefones
             (
                fk_fornecedor, 
                tipo_telefone, 
                telefone
            )
            VALUES (
                '{$fk_fornecedor}',
                '{$this->getTipoTelefone()}',
                '{$this->getTelefone()}'
             )";
            $this->conn->execute($query);
        } else {
            APP::return_response(false, "ID do fornecedor inválido. Entre em contato com o administrador.");
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
    
    function select_telefone($fk_fornecedor){
        $query = "
            SELECT 
                * 
            FROM 
                fornecedores_telefones 
            WHERE TRUE 
                AND fk_fornecedor = '{$fk_fornecedor}' 
                AND ATIVO = '1' 
        ";
        return $this->conn->fetch_all($query);
    }
    
    function desativa_telefone($fk_fornecedor){
        $query = "
            UPDATE 
                fornecedores_telefones
            SET
                ativo = '0'
            WHERE TRUE
                AND fk_fornecedor = '$fk_fornecedor'
                AND ativo = '1'
        ";
        $this->conn->execute($query);
    }

}
