<?php

class MOEDA {

    static function moeda_br_para_mysql($valor) {
        $valor2 = str_replace('.', '', $valor);
        return str_replace(',', '.', $valor2);
    }

    static function moeda_mysql_para_br($valor) {
        return number_format($valor, 2, ',', '.');
    }
    
    static function converte_moeda_para_bigint($valor) {
        $valor_final = $valor * 100;
        $valor2 = str_replace('.', '', $valor_final);
        return str_replace(',', '', $valor2);
    }

    static function reais_to_centavos($reais) {
        return self::moeda_br_para_mysql($reais) * 100;
    }
    
    static function int_to_mysql($valor){
        $valor2 = MOEDA::moeda_mysql_para_br($valor);
        return MOEDA::moeda_br_para_mysql($valor2);
    }
}
