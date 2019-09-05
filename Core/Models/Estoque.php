<?php

class Estoque {

    private $conn;
    private $filiado;

    function __construct() {
        $this->conn = DB::get_instance();
    }
    
    function get_filial_sessao() {
        $this->filial = $_SESSION['id_filiado'];
        return $this->filiado;
    }
    
    function list_estoque_filial($filiado){
        $query = "
            SELECT
                estoque_filiado.id_estoque_filiado as id_estoque,
                produtos.ncm_codigo,
                produtos.nome,
                produtos.ncm_descricao,
                estoque_filiado.quantidade,
                estoque_filiado.preco_unidade,
                medidas.descricao
            FROM
                estoque_filiado
            INNER JOIN produtos on produtos.id_produto = estoque_filiado.fk_produto
            INNER JOIN medidas on medidas.id_medida = estoque_filiado.fk_medida
            WHERE
                TRUE 
                AND fk_filiado = '{$filiado}'
                AND estoque_filiado.ativo = '1'
        ";
        return $this->conn->fetch_all($query);
    }
    
    function verifica_existe_prod_estoque($fk_produto, $fk_filiado)
    {
        $query = "
            SELECT 
                id_estoque_filiado,
                quantidade, 
                preco_unidade,
                fk_medida 
            FROM 
                estoque_filiado 
            WHERE TRUE 
                AND fk_filiado  = '$fk_filiado'
                AND fk_produto  = '$fk_produto'
                AND ativo       = '1'    
        ";
        return $this->conn->fetch($query);
    }
    
    function update_compra_estoque($id_estoque_filiado, $quantidade, $preco_unidade){
        $query = "
            UPDATE 
                estoque_filiado
            SET
                quantidade = '{$quantidade}',
                preco_unidade = '{$preco_unidade}'
            WHERE TRUE
                AND id_estoque_filiado = '{$id_estoque_filiado}'
        ";
        $this->conn->execute($query);
        return true;
    }
    
    function insert_compra_estoque($fk_filiado, $fk_produto, $fk_medida, $quantidade, $valor){
        $query = "
            INSERT INTO 
                estoque_filiado
            (fk_filiado, fk_produto, fk_medida, quantidade, preco_unidade)
            VALUES(
                '{$fk_filiado}',
                '{$fk_produto}',
                '{$fk_medida}',
                '{$quantidade}',
                '{$valor}'
            )
        ";
        $this->conn->execute($query);
        return true;
    }
    
    function calcular_valor_estoque($qtd_estoque,$preco_uni_estoque,$qtd_compra,$preco_unid_compra){
        $estoque_preco_total = $qtd_estoque * $preco_uni_estoque;
        $compra_preco_total = $qtd_compra * $preco_unid_compra;
   
        $result = ($estoque_preco_total + $compra_preco_total) / ($qtd_estoque + $qtd_compra);
    
        return intval($result);
    } 
}
