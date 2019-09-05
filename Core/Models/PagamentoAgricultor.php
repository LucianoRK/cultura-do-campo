<?php

class PagamentoAgricultor {
    
    private $conn;
    private $data_pagamento;
    private $obs_pagamento;

    function __construct() {
        $this->conn = DB::get_instance();
    }
    
    function get_data_pagamento() {
        return $this->data_pagamento;
    }
    
    function get_obs_pagamento() {
        return $this->obs_pagamento;
    }
    
    function set_data_pagamento($data_pagamento) {
        if (isset($data_pagamento) && !empty($data_pagamento)) {
            $this->data_pagamento = $data_pagamento;
        } else {
            APP::return_response(false, "Por favor, selecione a data de pagamento");
        }
    }
    
    function set_obs_pagamento($obs_pagamento) {
        if (isset($obs_pagamento) && !empty($obs_pagamento)) {
            $this->obs_pagamento = $obs_pagamento;
        } else {
            $this->obs_pagamento = false;
        }
    }
    
    function insert_pagamento_agricultor($fk_compra, $parcelas, $valor_total){
        $fk_filiado         = SESSION::get_id_filiado();
        $valor_parcela      = MOEDA::converte_moeda_para_bigint($valor_total / $parcelas);
        $valor_total_final  = MOEDA::converte_moeda_para_bigint($valor_total);
                
        for($i=1; $i <= $parcelas; $i++){
            if($i == "1"){
                $data_pagamento = $this->get_data_pagamento();
            }else{
                $mes = ($i - 1);
                $data_pagamento = date('Y-m-d', strtotime("+ $mes month", strtotime($this->get_data_pagamento())));
            }
            
            $query = "
                INSERT INTO
                    pagamentos_agricultores
                (fk_filiado, fk_compra, n_parcela ,data_pagamento, obs, valor_parcela, valor_total)
                VALUES 
                (
                    '{$fk_filiado}',
                    '{$fk_compra}',
                    '{$i}',
                    '{$data_pagamento}',
                    '{$this->get_obs_pagamento()}',
                    '{$valor_parcela}',
                    '{$valor_total_final}'
                )
            ";
                    
            $this->conn->execute($query);
        }
        return true;
    }
    
    function select_pagamento_especifico($id){
        $query = "
            SELECT
                *
            FROM pagamentos_agricultores
            WHERE TRUE
                AND fk_compra = '{$id}'
                AND ativo = '1'
        ";
        return $this->conn->fetch($query);
    }

}
