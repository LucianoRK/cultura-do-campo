<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DATE
 *
 * @author Notheros
 */
class DATE
{

    public static function mysql_to_date($date)
    {
        return date("d/m/Y", strtotime($date));
    }

    public static function date_to_mysql($date)
    {
        $explode = explode("/", $date);
        if (count($explode) === 3) {
            if (checkdate($explode[1], $explode[0], $explode[2])) {
                return date('Y-m-d',
                    strtotime($explode[2]."-".$explode[1]."-".$explode[0]));
            } else {
                APP::return_response(false, "A data selecionada é inválida");
            }
        } else {
            APP::return_response(false, "Formato da data inválido");
        }
    }

    public static function timestamp_to_utc($dt)
    {
        $date = new DateTime($dt, new DateTimeZone('America/Sao_Paulo'));
        $data = $date->format("Y-m-d\TH:i:sP");
        return $data;
    }
}