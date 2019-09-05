<?php

class Dependente {

    private $conn;
    private $nomeDependente;
    private $dataNascimento;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_dependente($id_agricultor) {
        $query = "
            INSERT INTO dependentes
            (fk_agricultor, nome_dependente, data_nascimento)
            VALUES (
                '{$id_agricultor}',
                '{$this->getNomeDependente()}',
                '{$this->getDataNascimento()}'
            )
        ";
        $this->conn->execute($query);
    }

    function getNomeDependente() {
        return $this->nomeDependente;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function setNomeDependente($nomeDependente) {
        if ($nomeDependente) {
            $this->nomeDependente = STRINGS::limpar($nomeDependente);
        } else {
            APP::return_response(false, "Favor informar o NOME DO DEPENDENTE");
        }
    }

    function setDataNascimento($dataNascimento) {
        if (VALIDA::data($dataNascimento)) {
            $this->dataNascimento = DATE::date_to_mysql($dataNascimento);
        } else {
            APP::return_response(false, "A DATA DE NASCIMENTO DO DEPENDENTE é inválido");
        }
    }

}
