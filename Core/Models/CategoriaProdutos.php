<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrabalhadorRural
 *
 * @author Notheros
 */
class CategoriaProdutos {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }
    
    function select_todas_categorias() {
        $query = "SELECT
                    id_categoria,
                    nome
                 FROM
                    categoria_produtos
                 WHERE 
                    ativo = '1' ";
                    
        return $this->conn->fetch_all($query);
    }
    
    function select_categoria($id_categoria){
        $query = "SELECT
                    nome
                 FROM
                    categoria_produtos
                 WHERE 
                    id_categoria = '$id_categoria' ";
                    
        return $this->conn->fetch($query);
    }
}
