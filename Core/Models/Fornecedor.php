<?php

class Fornecedor {
    
    private $conn;
    private $nome_fantasia;
    private $cnpj;
    private $razao_social;
    

    function __construct() {
        $this->conn = DB::get_instance();
    }
    
     function getNomeFantasia() {
        return $this->nome_fantasia;
    }
    
     function getCnpj() {
        return $this->cnpj;
    }
    
     function getRazaoSocial() {
        return $this->razao_social;
    }
    
    function setNomeFantasia($nome_fantasia) {
        if(!empty($nome_fantasia)){
            if(STRINGS::is_nome_valido($nome_fantasia)){
                $this->nome_fantasia = $nome_fantasia;
            }else{
                APP::return_response(false, "Preencha o campo Nome fantasia corretamente");
            }
        }else{
            APP::return_response(false, "O campo Nome fantasia é obrigatório");
        }
    }
    
    function setCnpj($cnpj) {
        $valida_cnpj = VALIDA::isCNPJ($cnpj);
        
        if($valida_cnpj){
            $valida_cnpj = VALIDA::existe_cnpj_fornecedor($cnpj);
            if($valida_cnpj){
                APP::return_response(false, "O cnpj inserido já possui cadastro");
            }else{
                $this->cnpj = $cnpj;
            }
        }else{
            APP::return_response(false, "O cnpj informado é inválido");
        }
    }
    
    function setRazaoSocial($razao_social) {
        if(!empty($razao_social)){
            if(STRINGS::is_nome_valido($razao_social)){
                $this->razao_social = $razao_social;
            }else{
                APP::return_response(false, "Razão social invalida");
            }
        }else{
            APP::return_response(false, "O campo Razão social é obrigatório");
        }
    }
    
    function insertFornecedor($fk_endereco, $fk_filiado){
        
        $query = "
            INSERT INTO 
                fornecedores
            (fk_filiado, fk_endereco, nome_fantasia, cnpj, razao_social)
            VALUES(
                '{$fk_filiado}',
                '{$fk_endereco}',
                '{$this->getNomeFantasia()}',
                '{$this->getCnpj()}',
                '{$this->getRazaoSocial()}' 
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }
    
    function updateFornecedor($id_fornecedor) {    
        $query = "
            UPDATE 
                fornecedores
            SET
                nome_fantasia = '{$this->getNomeFantasia()}', 
                razao_social = '{$this->getRazaoSocial()}'
            WHERE TRUE
                AND id_fornecedor = '$id_fornecedor'
                AND ativo = '1'
            ";
        $this->conn->execute($query);
    }
    
    function select_todos_fornecedores($filiado){
        $query = "
            SELECT 
                id_fornecedor, nome_fantasia, razao_social, cnpj
            FROM fornecedores
            WHERE TRUE
               AND fk_filiado = '{$filiado}'
               AND ativo = 1";
               
        return $this->conn->fetch_all($query);
    }
    
    function select_fornecedor($id_fornecedor){
        $query = "
            SELECT 
                *
            FROM fornecedores
            WHERE TRUE
                AND id_fornecedor = '{$id_fornecedor}'
                AND ATIVO = '1'
        ";       
        return $this->conn->fetch($query);
    }
    
    function inativar_fornecedor($id_fornecedor, $fk_filiado, $fk_endereco){
        // Fornecedor
        $q = "
            UPDATE fornecedores
            SET ativo = '0'
            WHERE TRUE
                AND id_fornecedor = '{$id_fornecedor}'
                AND fk_filiado = '{$fk_filiado}'
        ";
        $this->conn->execute($q);
        
        // Telefones
        $q2 = "
            UPDATE fornecedores_telefones
            SET ativo = '0'
            WHERE TRUE
                AND fk_fornecedor = '{$id_fornecedor}'
        ";
        $this->conn->execute($q2);
        
        // Endereço
        $q3 = "
            UPDATE enderecos
            SET ativo = '0'
            WHERE TRUE
                AND id_endereco = '{$fk_endereco}'
        ";
        $this->conn->execute($q3);
        
        // Contas Bancarias
        $q4 = "
            UPDATE contas_bancarias
            SET ativo = '0'
            WHERE TRUE
                AND fk_fornecedor = '{$id_fornecedor}'
        ";
        $this->conn->execute($q4);
    }
}
