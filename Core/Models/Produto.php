<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produto
 *
 * @author Notheros
 */
class Produto {

    private $id_produto;
    private $ncm_codigo;
    private $ncm_descricao;
    private $is_organico;
    private $is_hidroponico;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_produtos() {
        $query = "
            SELECT
                id_produto,
                ncm_descricao as nome
            FROM produtos
            WHERE TRUE
                AND produtos.ativo = 1
        ";
        return $this->conn->fetch_all($query);
    }

    function is_produto_valido($id_produto) {
        $query = "
            SELECT
                id_produto
            FROM produtos
            WHERE TRUE
                AND produtos.ativo = 1
                AND id_produto = '{$id_produto}'
        ";
        return $this->conn->fetch($query);
    }


    function get_id_produto() {
        return $this->id_produto;
    }

    function set_id_produto($id_produto) {
        $produto = $this->is_produto_valido($id_produto);
        if ($produto) {
            $this->id_produto = $id_produto;
        } else {
            APP::return_response(false, "O produto selecionado é inválido");
        }
    }
    
    function select_produtos_por_categoria($categoria) {
        $query = "
            SELECT
                id_produto,
                nome
            FROM produtos
            WHERE TRUE
                AND fk_categoria = '$categoria'
                AND ativo = 1
        ";
        return $this->conn->fetch_all($query);
    }
    
    function select_produto($id_produto){
        $query = "
            SELECT
                nome,
                ncm_codigo,
                ncm_descricao,
                fk_medida
            FROM 
                produtos
            WHERE
                id_produto = '$id_produto'
            AND 
                ativo = '1' ";
        
        return $this->conn->fetch($query);
    }

    function get_ncm_codigo() {
        return $this->ncm_codigo;
    }

    function get_ncm_descricao() {
        return $this->ncm_descricao;
    }

    function set_ncm_codigo($ncm_codigo) {
        $this->ncm_codigo = $ncm_codigo;
    }

    function set_ncm_descricao($ncm_descricao) {
        $this->ncm_descricao = STRINGS::limpar($ncm_descricao);
    }

    function is_organico() {
        return $this->is_organico;
    }

    function is_hidroponico() {
        return $this->is_hidroponico;
    }

    function set_is_organico($is_organico) {
        $this->is_organico = $is_organico;
    }

    function set_is_hidroponico($is_hidroponico) {
        $this->is_hidroponico = $is_hidroponico;
    }

}
