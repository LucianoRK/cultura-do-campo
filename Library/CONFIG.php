<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CONFIG
 *
 * @author Notheros
 */
class CONFIG {
    /*
     * General
     */
    static $PROJECT_NAME = "Cultura do Campo";
    static $TIMEZONE = 'America/Sao_Paulo';
    static $MASTER_PASSWD = 'cultura';
    /*
     * Login
     */
    static $LOGIN_COOKIE_LIFETIME = 86400;
    static $LOGIN_MAX_FAILED_ATTEMPTS = 3;
    static $LOGIN_NUMBER_ATTEMPS_DELAY = 5;
    static $LOGIN_SLEEP_BASE_DELAY = 2;
    static $LOGIN_FAILED_ATTEMPTS_RANGE = 15; // em minutos 
    static $LOGIN_RECAPTCHA = FALSE;
    static $LOGIN_CAPTCHA_SECRET = '6Le8m4QUAAAAAIJ1IykZy0aEMkaVUASnyKKwIzEm';
    /*
     * Mail
     */
    static $MAIL_USERNAME = 'app.culturadocampo@gmail.com';
    static $MAIL_PASSWORD = 'INFODMZ@626';
    static $MAIL_SMPT = 'smtp.gmail.com';
    static $MAIL_PORT = 465;
    static $MAIL_PROTOCOL = 'ssl';
    /*
     * Database
     */
    static $DATABASE_HOST = 'cultura.cuzewnrvgibv.sa-east-1.rds.amazonaws.com';
    static $DATABASE_USER = 'root';
    static $DATABASE_PASSWD = 'INFODMZ626';
    static $DATABASE_NAME = 'db_cultura';

}
