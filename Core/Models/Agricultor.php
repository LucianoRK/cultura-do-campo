<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Agricultor
 *
 * @author Notheros
 */
class Agricultor {

    private $conn;
    private $caepf;
    private $rg;
    private $integrantesUpf;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_agricultor($id_usuario, $id_estado_civil) {
        $query = "
            INSERT INTO agricultores
            (fk_usuario, fk_estado_civil, caepf, rg, integrantes_upf)
            VALUES(
                '{$id_usuario}',
                '{$id_estado_civil}',
                '{$this->getCaepf()}',
                '{$this->getRg()}',
                '{$this->getIntegrantesUpf()}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function select_agricultor_especificado($id_agricultor) {
        $query = "
            SELECT  id_agricultor, nome, caepf, rg
            FROM agricultores
            INNER JOIN usuarios ON id_usuario = fk_usuario
            WHERE id_agricultor = '{$id_agricultor}'
        ";
        return $this->conn->fetch($query);
    }

    function select_todos_agricultores_filiado($fk_filiado) {
        $query = "SELECT
                    fk_agricultor,
                    usuarios.nome,
                    usuarios.cpf
                 FROM
                    associados
                 INNER JOIN
                    usuarios ON id_usuario = fk_agricultor
                 WHERE 
                    fk_filiado = '{$fk_filiado}'";

        return $this->conn->fetch_all($query);
    }

    function select_agricultores_ativos() {
//        $id_tipo_usuario = SESSION::get_id_tipo_usuario();
//        if ($id_tipo_usuario == 1) {
            return $this->select_todos_agricultores();
//        } else if ($id_tipo_usuario == 2) {
////            return $this->select_agricultores_do_coordenador();
//        } else if ($id_tipo_usuario == 5) {
////            return $this->select_agricultores_do_tecnico();
//        } else {
//            return array();
//        }
    }

    function select_todos_agricultores() {
        $query = "
            SELECT 
                id_agricultor, id_usuario, nome, cpf
            FROM 
                usuarios
            INNER JOIN agricultores ON fk_usuario = id_usuario
            WHERE TRUE
                AND fk_tipo_usuario = 6
                AND ativo = 1";
        return $this->conn->fetch_all($query);
    }

    function select_agricultor_filial($id_agricultor) {
        $query = "
            SELECT 
                nome
            FROM 
                usuarios
            WHERE 
                id_usuario = '$id_agricultor'
        ";
        return $this->conn->fetch($query);
    }

    function insert_vinculo_agricultor_filiado($id_agricultor, $id_filiado) {
        $query = "
            INSERT INTO 
                associados
            (fk_agricultor, fk_filiado)
            VALUES(
                '{$id_agricultor}',
                '{$id_filiado}'
            )
        ";
        $this->conn->execute($query);
    }
    
    function localizar_agricultor_por_cpf($term) {
        $query = "
            SELECT 
                id_agricultor, usuarios.nome, caepf
            FROM 
                usuarios
            INNER JOIN agricultores ON fk_usuario = id_usuario
            WHERE TRUE
                AND fk_tipo_usuario = 6
                AND cpf = '{$term}'
                AND usuarios.ativo = 1 LIMIT 1";
        return $this->conn->fetch($query);
    }

    function getCaepf() {
        return $this->caepf;
    }

    function setCaepf($caepf) {
        $this->caepf = STRINGS::limpar($caepf);
    }

    function getRg() {
        return $this->rg;
    }

    function setRg($rg) {
        $this->rg = STRINGS::limpar($rg);
    }

    function getIntegrantesUpf() {
        return $this->integrantesUpf;
    }

    function setIntegrantesUpf($integrantesUpf) {
        if (is_numeric($integrantesUpf) && $integrantesUpf > 0) {
            $this->integrantesUpf = $integrantesUpf;
        } else {
            APP::return_response(false, "Informe um número de integrantes válido");
        }
    }

}
