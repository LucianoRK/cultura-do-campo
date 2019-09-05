<?php

class ContaBancaria {
    
    private $conn;
    private $banco;
    private $agencia;
    private $conta;
    

    function __construct() {
        $this->conn = DB::get_instance();
    }
    
     function getBanco() {
        return $this->banco;
    }
    
     function getAgencia() {
        return $this->agencia;
    }
    
     function getConta() {
        return $this->conta;
    }
    
    function setBanco($banco) {
        if(!empty($banco)){
           $this->banco = $banco;
        }
    }
    
    function setAgencia($agencia) {
        if(!empty($agencia)){
            $this->agencia = $agencia;
        }
    }
    
    function setConta($conta) {
        if(!empty($conta)){
            $this->conta = $conta;
        }
    }
    
    function insertContaBancaria($fk_fornecedor){
        $query = "
            INSERT INTO 
                contas_bancarias
            (fk_fornecedor, banco, agencia, conta)
            VALUES(
                '{$fk_fornecedor}',
                '{$this->getBanco()}',
                '{$this->getAgencia()}',
                '{$this->getConta()}'
            )
        ";
        $this->conn->execute($query);
    }
    
    function updateContaBancaria($id_conta_bancaria){
        $query = "
            UPDATE 
                contas_bancarias
            SET
                banco = '{$this->getBanco()}', 
                agencia = '{$this->getAgencia()}',
                conta = '{$this->getConta()}'
            WHERE TRUE
                AND id_conta_bancaria = '$id_conta_bancaria'
                AND ativo = '1'
        ";
        $this->conn->execute($query);
    }
    
    function select_conta_bancaria($fk_fornecedor){
        $query = "
            SELECT 
                * 
            FROM 
                contas_bancarias 
            WHERE TRUE 
                AND fk_fornecedor = '{$fk_fornecedor}' 
                AND ATIVO = '1' 
        ";
        return $this->conn->fetch($query);
    }
}
