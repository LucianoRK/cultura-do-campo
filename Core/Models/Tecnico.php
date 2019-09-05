<?php

class Tecnico {

    private $conn;
    private $idTecnico;
    private $rg;
    private $formacao;
    private $areaAtuacao;
    private $entidade;
    private $email;
    private $observacao;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insertTecnico($id_coordenador, $id_usuario, $id_municipio) {
        $query = "
            INSERT INTO tecnicos
            (
                fk_usuario_coordenador,
                fk_usuario,
                fk_municipio,
                rg,
                formacao,
                area_atuacao,
                entidade,
                observacao
            )
            VALUES (
                '{$id_coordenador}',
                '{$id_usuario}',
                '{$id_municipio}',
                '{$this->getRg()}',
                '{$this->getFormacao()}',
                '{$this->getAreaAtuacao()}',
                '{$this->getEntidade()}',
                '{$this->getObservacao()}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function selectTecnicosAtivos() {
        $id_tipo_usuario = SESSION::get_id_tipo_usuario();
        if ($id_tipo_usuario == 1) {
            return $this->select_todos_tecnicos();
        } else if ($id_tipo_usuario == 2) {
            return $this->select_tecnicos_coordenador();
        } else {
            return array();
        }
    }

    function select_todos_tecnicos() {
        $query = "
            SELECT 
                id_tecnico, id_usuario, nome
            FROM tecnicos
            INNER JOIN usuarios ON tecnicos.fk_usuario = id_usuario
            WHERE TRUE
               AND usuarios.ativo = 1";
        return $this->conn->fetch_all($query);
    }

    function select_tecnicos_coordenador() {
        $id_usuario_coordenador = SESSION::get_id_usuario();
        $query = "
            SELECT 
                id_tecnico, id_usuario, nome
            FROM tecnicos
            INNER JOIN usuarios ON tecnicos.fk_usuario = id_usuario
            WHERE TRUE
               AND fk_usuario_coordenador = '{$id_usuario_coordenador}'
               AND usuarios.ativo = 1";
        return $this->conn->fetch_all($query);
    }

    function select_tecnico_from_id_usuario($id_usuario) {
        $query = "
            SELECT 
                id_tecnico
            FROM tecnicos
            WHERE TRUE
               AND fk_usuario = '{$id_usuario}'";
        return $this->conn->fetch($query);
    }

    function getIdTecnico() {
        return $this->idTecnico;
    }

    function getRg() {
        return $this->rg;
    }

    function getFormacao() {
        return $this->formacao;
    }

    function getAreaAtuacao() {
        return $this->areaAtuacao;
    }

    function getEntidade() {
        return $this->entidade;
    }

    function getEmail() {
        return $this->email;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setIdTecnico($idTecnico) {
        $this->idTecnico = $idTecnico;
    }

    function setRg($rg) {
        if (!empty($rg)) {
            $this->rg = STRINGS::limpar($rg);
        } else {
            APP::return_response(false, "Favor informar o RG do técnico.");
        }
    }

    function setFormacao($formacao) {
        if (!empty($formacao)) {
            $this->formacao = STRINGS::limpar($formacao);
        } else {
            APP::return_response(false, "Favor informar o FORMAÇÃO do técnico.");
        }
    }

    function setAreaAtuacao($areaAtuacao) {
        if (!empty($areaAtuacao)) {
            $this->areaAtuacao = STRINGS::limpar($areaAtuacao);
        } else {
            APP::return_response(false, "Favor informar a ÁREA DE ATUAÇÃO.");
        }
    }

    function setEntidade($entidade) {
        if (!empty($entidade)) {
            $this->entidade = STRINGS::limpar($entidade);
        } else {
            APP::return_response(false, "Favor informar a ENTIDADE a qual pertence.");
        }
    }

    function setEmail($email) {
        if (!empty($email)) {
            $this->email = STRINGS::limpar($email);
        } else {
            APP::return_response(false, "Favor informar o E-MAIL do técnico.");
        }
    }

    function setObservacao($observacao) {
        $this->observacao = STRINGS::limpar($observacao);
    }

}
