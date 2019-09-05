<?php

class VALIDA {

    static function cpf($cpf) {
        if (empty($cpf)) {
            return false;
        }
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
                $cpf == '11111111111' ||
                $cpf == '22222222222' ||
                $cpf == '33333333333' ||
                $cpf == '44444444444' ||
                $cpf == '55555555555' ||
                $cpf == '66666666666' ||
                $cpf == '77777777777' ||
                $cpf == '88888888888' ||
                $cpf == '99999999999') {
            return false;
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    static function rg($rg) {
        if ($rg && is_numeric($rg)) {
            return true;
        } else {
            return false;
        }
    }

    static function data($data) {
        if ($data) {
            $data = explode('/', $data);
            if (checkdate($data[1], $data[0], $data[2])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function existe_cpf($cpf) {
        $conn = DB::get_instance();
        $query = "
            SELECT 
                cpf
            FROM 
                usuarios
            WHERE TRUE
                AND cpf = '{$cpf}'
        ";
        $row = $conn->row_count($query);

        if ($row != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    static function existe_cnpj_fornecedor($cnpj) {
        $fk_filiado = SESSION::get_id_filiado();
        
        $conn = DB::get_instance();
        $query = "
            SELECT 
                cnpj
            FROM 
                fornecedores
            WHERE TRUE
                AND cnpj = '{$cnpj}'
                AND fk_filiado = '{$fk_filiado}'   
        ";
        $row = $conn->row_count($query);

        if ($row != 0) {
            return true;
        } else {
            return false;
        }
    }

    static function existe_email($email) {
        $conn = DB::get_instance();
        $query = "
            SELECT 
                email
            FROM 
                usuarios
            WHERE TRUE
                AND email = '{$email}'
        ";
        $row = $conn->row_count($query);

        if ($row != 0) {
            return true;
        } else {
            return false;
        }
    }

    static function existe_usuario($usuario) {
        $conn = DB::get_instance();
        $query = "
            SELECT 
                usuario
            FROM 
                usuarios
            WHERE TRUE
                AND usuario = '{$usuario}'
        ";
        $row = $conn->row_count($query);

        if ($row != 0) {
            return true;
        } else {
            return false;
        }
    }

    static function is_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    static function isValidLongitude($longitude) {
        if (preg_match("/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/", $longitude)) {
            return true;
        } else {
            return false;
        }
    }

    static function isValidLatitude($latitude) {

        if (preg_match("/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/", $latitude)) {
            return true;
        } else {
            return false;
        }
    }

    static function isCNPJ($cnpj) {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            return false;
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = 0;
            $soma2 = 0;

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                $soma2 += ($cnpj{$i} * $k);

                if ($i < 12) {
                    $soma1 += ($cnpj{$i} * $j);
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            return (($cnpj{12} == $digito1) and ( $cnpj{13} == $digito2));
        }
    }

    /*
     * Return true se a data_inicio for menor que a data_fim,
     * false caso contrário
     */

    static function periodo_data($data_inicio, $data_fim) {
        try {
            if (strtotime($data_inicio) < strtotime($data_fim)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
           return false;
        }
    }

}
