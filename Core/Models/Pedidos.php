<?php


class Pedidos {

    private $conn;
    private $fk_compra;
    private $fk_categoria;
    private $fk_produto;
    private $produto_medida;
    private $qtd;
    private $valor;

    function __construct() {
        $this->conn = DB::get_instance();
    }
    
    function select_todos_estados() {
        $query = "SELECT nome, uf FROM estados";
        return $this->conn->fetch_all($query);
    }
    
    function insert_novo_pedido($id_compra) {
        $query = "
            INSERT INTO
                pedidos
            (fk_compra, fk_categoria, fk_produto, produto_medida, qtd, valor)
            VALUES 
            (
                '{$id_compra}',
                '{$this->get_fk_categoria()}',
                '{$this->get_fk_produto()}',
                '{$this->get_produto_medida()}',
                '{$this->get_qtd()}',
                '{$this->get_valor()}'
            )
        ";
        $this->conn->execute($query);
        return true;
    }
    
    function get_fk_compra() {
        return $this->fk_compra;
    }
    
    function get_fk_categoria() {
        return $this->fk_categoria;
    }
    
    function get_fk_produto() {
        return $this->fk_produto;
    }
    
    function get_produto_medida() {
        return $this->produto_medida;
    }
    
    function get_qtd() {
        return $this->qtd;
    }
    
    function get_valor() {
        return $this->valor;
    }
    
    function set_fk_compra($id_compra) {
        if (isset($id_compra) && !empty($id_compra)) {
            $this->fk_compra = $id_compra;
        } else {
            APP::return_response(false, "Problema em realizar a compra, relogue do sistema");
        }
    }
    
    function set_fk_categoria($id_categoria) {
        if (isset($id_categoria) && !empty($id_categoria)) {
            $this->fk_categoria = $id_categoria;
        } else {
            APP::return_response(false, "Por favor, selecione a categoria");
        }
    }
    
    function set_fk_produto($id_produto) {
        if (isset($id_produto) && !empty($id_produto)) {
            $this->fk_produto = $id_produto;
        } else {
            APP::return_response(false, "Por favor, selecione o produto");
        }
    }
    
    function set_produto_medida($id_medida) {
        if (isset($id_medida) && !empty($id_medida)) {
            $this->produto_medida = $id_medida;
        } else {
            APP::return_response(false, "Por favor, selecione a medida do produto");
        }
    }
    
    function set_qtd($qtd) {
        if (isset($qtd) && !empty($qtd)) {
            $this->qtd = $qtd;
        } else {
            APP::return_response(false, "Por favor, preecha a quantida do produto");
        }
    }
    
    function set_valor($valor_prod) {
        if (isset($valor_prod) && !empty($valor_prod)) {
            $this->valor = MOEDA::converte_moeda_para_bigint($valor_prod);
        } else {
            APP::return_response(false, "Por favor, preecha o valor do produto");
        }
    }
    
    function select_todos_produtos_compra($fk_compra){
        $query = "
            SELECT
                *
            FROM pedidos
            WHERE TRUE
                AND fk_compra = '{$fk_compra}'
        ";
        return $this->conn->fetch_all($query);
    }

}
