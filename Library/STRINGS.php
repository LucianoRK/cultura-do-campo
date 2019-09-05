<?php

class STRINGS
{

    static function limpar($str)
    {
        $striped_str = addslashes(strip_tags($str));
        $striped_str = self::remove_whitespace($striped_str);
        return $striped_str;
    }

    static function proper_case($string)
    {
        $ignorar = array('do', 'dos', 'da', 'das', 'de');
        $array   = explode(' ', strtolower($string));
        $out     = '';
        foreach ($array as $ar) {
            $out .= ( in_array($ar, $ignorar) ? $ar : ucfirst($ar) ).' ';
        }
        return trim($out);
    }

    static function remove_whitespace($string)
    {
        return preg_replace('/\s{2,}/', ' ', trim($string));
    }

    static function formatCPF($cpf)
    {
        if ($cpf && strlen($cpf) == 11) {
            $mask = "%s%s%s.%s%s%s.%s%s%s-%s%s";
            return vsprintf($mask, str_split($cpf));
        }
    }

    static function remove_accents($str)
    {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô',
            'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì',
            'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?',
            '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O',
            'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i',
            'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a',
            'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e',
            'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i',
            'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n',
            'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
            's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y',
            'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u',
            'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace($a, $b, $str);
    }

    static function is_telefone_valido($phone)
    {
        $pattern = "/^(?=.*[0-9])[- +()0-9]+$/";
        $result  = preg_match($pattern, $phone);
        return $result;
    }

    static function is_email_valido($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    static function is_nome_valido($nome)
    {
        if (preg_match('/^[a-z .\-\']+$/i', $nome)) {
            return true;
        } else {
            return false;
        }
    }

    static function is_usuario_valido($senha)
    {
        if (preg_match("/\\s/", $senha)) {
            return false;
        } else {
            return true;
        }
    }

    static function is_senha_valida($senha)
    {
        if (preg_match("/\\s/", $senha)) {
            return false;
        } else {
            return true;
        }
    }

    static function string_to_uri($string)
    {
        $string = self::remove_accents($string);
        $string = strtolower($string);
        $string = preg_replace("/[^\w]+/", "-", $string);
        $string = trim($string, "-");
        return $string;
    }

    static function readable_regex($regex)
    {
        $regex = str_replace("^", "", $regex);
        $regex = str_replace("\/", "/", $regex);
        $regex = str_replace("?$", "", $regex);
        $regex = str_replace("(\d+)", "{int}", $regex);
        $regex = str_replace("([a-zA-Z\-]+)", "{string}", $regex);
        return $regex;
    }

    static function gen_password($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index  = rand(0, $count - 1);
            $result .= substr($chars, $index, 1);
        }
        return $result;
    }

    static function write_log($text)
    {
        $fp = fopen('log.txt', 'w');
        fwrite($fp, $text);
        fclose($fp);
    }

    static function regex_to_url($regex)
    {
        $regex = str_replace("^", "", $regex);
        $regex = str_replace("\/", "/", $regex);
        $regex = str_replace("?$", "", $regex);
        $regex = str_replace("(\d+)", "{int}", $regex);
        $regex = str_replace("([a-zA-Z\-]+)", "{string}", $regex);
        return $regex;
    }
}