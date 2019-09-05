<?php


class Compras {

    private $conn;
    private $valor_total;
    private $status_compra;

    function __construct() 
    {
        $this->conn = DB::get_instance();
    }
    
    function get_valor_total() 
    {
        return $this->valor_total;
    }
    
    function get_status_compra() 
    {
        return $this->status_compra;
    } 
    
    function set_valor_total($valor_total) 
    {
        if (isset($valor_total) && !empty($valor_total)) {
            $this->valor_total = MOEDA::converte_moeda_para_bigint($valor_total);
        } else {
            APP::return_response(false, "Erro: Sem valor total");
        }
    }
    
    function set_status_compra($status) 
    {
        /* 
        COMPRA
        Status
        1 - Compra feita e confirmada
        2 - Compra confirmada mas precisa buscar os produtos
        3 - Compra cancelada (Estornada)
        */
        
        if (isset($status) && !empty($status)) {
            if($status == "1"){
                $this->status_compra = "2";
            }else{
                $this->status_compra = "1";
            }
        } else {
            APP::return_response(false, "Por favor, selecione buscar o produto 'Sim' ou 'Não' ");
        }
    }
    
    function insert_nova_compra($fk_produtor) 
    {
        $fk_operador = SESSION::get_id_usuario();
        $fk_filiada  = SESSION::get_id_filiado();
        
        $query = "
            INSERT INTO
                compras
            (fk_operador, fk_produtor, fk_filiado, valor_total, status)
            VALUES 
            (
                '{$fk_operador}',
                '{$fk_produtor}',
                '{$fk_filiada}',
                '{$this->get_valor_total()}',
                '{$this->get_status_compra()}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }
    
    function select_todas_compras_filiado($id_filiado)
    {
        $query = "
            SELECT
                *
            FROM compras
            WHERE TRUE
                AND fk_filiado = '{$id_filiado}'
            ORDER BY
               id_compra
        ";
        return $this->conn->fetch_all($query);
    }
    
    function select_compra_especificada($id_compra)
    {
        $query = "
            SELECT
                id_compra,
                fk_operador,
                fk_produtor,
                fk_filiado,
                valor_total,
                status,
                data,
                ativo
            FROM compras
            WHERE TRUE
                AND id_compra = '{$id_compra}'
        ";
        return $this->conn->fetch($query);
    }
    
    function efetivar_compra($id_compra)
    {
        $query = "
            UPDATE compras
            SET
                status = '1'
            WHERE id_compra = '{$id_compra}'
        ";
        $this->conn->execute($query);
        return true;
    }
    

}
