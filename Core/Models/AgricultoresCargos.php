<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssociadosCargos
 *
 * @author Notheros
 */
class AgricultoresCargos {

    private $conn;
    private $cargo;
    private $dataInicio;
    private $dataTermino;
    private $observacoes;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_cargo($id_agricultor, $id_filiado) {

        if (!VALIDA::periodo_data($this->getDataInicio(), $this->getDataTermino())) {
            APP::return_response(false, "A data de TÉRMINO deve ser maior que a data de INÍCIO");
        }


        $query = "
            INSERT INTO agricultores_cargos
            (
                fk_agricultor, 
                fk_filiado, 
                cargo,
                data_inicio,
                data_fim,
                obs
            )
            VALUES (
                '{$id_agricultor}',
                '{$id_filiado}',
                '{$this->getCargo()}',
                '{$this->getDataInicio()}',
                '{$this->getDataTermino()}',
                '{$this->getObservacoes()}'
            )
        ";
        $this->conn->execute($query);
    }

    function getCargo() {
        return $this->cargo;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataTermino() {
        return $this->dataTermino;
    }

    function getObservacoes() {
        return $this->observacoes;
    }

    function setCargo($cargo) {
        if ($cargo) {

            $this->cargo = STRINGS::limpar($cargo);
        } else {
            APP::return_response(false, "Informe o CARGO deste agricultor");
        }
    }

    function setDataInicio($dataInicio) {
        if (VALIDA::data($dataInicio)) {
            $this->dataInicio = DATE::date_to_mysql($dataInicio);
        } else {
            APP::return_response(false, "Informe uma DATA DE INÍCIO válida");
        }
    }

    function setDataTermino($dataTermino) {
        if (VALIDA::data($dataTermino)) {
            $this->dataTermino = DATE::date_to_mysql($dataTermino);
        } else {
            APP::return_response(false, "Informe uma DATA DE TÉRMINO válida");
        }
    }

    function setObservacoes($observacoes) {
        $this->observacoes = STRINGS::limpar($observacoes);
    }

}
