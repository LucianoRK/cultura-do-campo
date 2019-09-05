<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DB {

    private static $instance;
    private $link;

    protected function __construct() {
        if (empty($this->link)) {
            try {
                $this->link = new PDO("mysql:host=" . CONFIG::$DATABASE_HOST . ';port=3306;dbname=' . CONFIG::$DATABASE_NAME, CONFIG::$DATABASE_USER, CONFIG::$DATABASE_PASSWD);
                $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->link->query('SET NAMES utf8');
                $this->link->query('SET CHARACTER SET utf8');
            } catch (PDOException $error) {
                APP::return_response(false, "Connection error");
            }
        }
    }

    static function get_instance($force_new_instance = false) {
        if ($force_new_instance) {
            return new DB();
        } else {
            if (!isset(self::$instance)) {
                $c = new DB();
                self::$instance = $c;
            }
            return self::$instance;
        }
    }

    function execute($query) {
        try {
            $sth = $this->link->prepare($query);
            $sth->execute();
        } catch (PDOException $exc) {
            LOG::writeLog($query);
            APP::return_response(false, $exc->getMessage());
        }
    }

    function fetch($query) {
        try {
            $sth = $this->link->query($query);
            return $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            LOG::writeLog($query);
            APP::return_response(false, $exc->getMessage());
        }
    }

    function fetch_all($query) {
        try {
            $sth = $this->link->query($query);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            LOG::writeLog($query);
            APP::return_response(false, $exc->getMessage());
        }
    }

    public function fetch_attr($query, $attribute) {
        try {
            $sth = $this->link->query($query);
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            if (isset($result[$attribute])) {
                return $result[$attribute];
            } else {
                throw new Exception("Atributo {$attribute} não encontrado");
            }
        } catch (PDOException $exc) {
            LOG::writeLog($query);
            APP::return_response(false, $exc->getMessage());
        }
    }

    function row_count($query) {
        $sth = $this->link->query($query);
        return $sth->rowCount();
    }

    function last_id() {
        $sth = $this->link->query("SELECT LAST_INSERT_ID()");
        return $sth->fetchColumn();
    }

    function beginTransaction() {
        $this->link->beginTransaction();
    }

    function commit() {
        $this->link->commit();
    }

    function rollback() {
        $this->link->rollBack();
    }

}
