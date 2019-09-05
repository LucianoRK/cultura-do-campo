<?php

set_time_limit(60);
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
spl_autoload_register("autoload");
//set_error_handler("error_handler");

date_default_timezone_set(CONFIG::$TIMEZONE);

function error_handler($errno, $errstr, $errfile, $errline) {

    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }
    switch ($errno) {
        case E_ERROR:
            $errno = "E_ERROR";
            break;
        case E_CORE_ERROR:
            $errno = "E_CORE_ERROR";
            break;
        case E_COMPILE_ERROR:
            $errno = "E_COMPILE_ERROR";
            break;
        case E_PARSE:
            $errno = "E_PARSE";
            break;
        case E_USER_ERROR:
            $errno = "E_USER_ERROR";
            break;
        case E_RECOVERABLE_ERROR:
            $errno = "E_RECOVERABLE_ERROR";
            break;
        case E_WARNING:
            $errno = "E_WARNING";
            break;
        case E_CORE_WARNING:
            $errno = "E_CORE_WARNING";
            break;
        case E_COMPILE_WARNING:
            $errno = "E_COMPILE_WARNING";
            break;
        case E_USER_WARNING:
            $errno = "E_USER_WARNING";
            break;
        case E_NOTICE:
            $errno = "E_NOTICE";
            break;
        case E_USER_NOTICE:
            $errno = "E_USER_NOTICE";
            break;
        case E_STRICT:
            $errno = "E_STRICT";
            break;
        default:
            $errno = "DESCONHECIDO";
    }
    APP::gravar_erro(basename($errfile), $errno, addslashes($errstr), $errline);

    return true;
}

function autoload($class) {
    if (is_readable(dirname(__FILE__) . "/Core/Models/" . $class . ".php")) {
        include(dirname(__FILE__) . "/Core/Models/" . $class . ".php");
    }
    if (is_readable(dirname(__FILE__) . '/Library/' . $class . ".php")) {
        include(dirname(__FILE__) . '/Library/' . $class . ".php");
    }
}

/**
 * (re)cria o .htaccess caso não exista
 */
if (!is_file(".htaccess")) {
    APP::check_htaccess();
}

session_start();
APP::start();
