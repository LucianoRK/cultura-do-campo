<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LOG
 *
 * @author Notheros
 */
class LOG {

    static function writeLog($string) {
        $fp = fopen('log.txt', 'a');
        fwrite($fp, "\n\n");
        fwrite($fp, date("Y/m/d g:i:s") . " -> " . trim($string) . "\n");
        fclose($fp);
    }

}
