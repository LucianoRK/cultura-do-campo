<?php

class PropriedadeRural {

    private $conn;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function insert_propriedade_rural($id_endereco, $id_certificacao, $id_agricultor) {
        $query = "
            INSERT INTO 
                propriedades_rurais
            (fk_endereco, fk_certificacao_organica, fk_agricultor)
            VALUES(
                '{$id_endereco}',
                '{$id_certificacao}',
                '{$id_agricultor}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function insert_vinculo_propriedade_tecnico($id_propriedade, $id_tecnico) {
        $query = "
            INSERT INTO 
                xref_propriedades_tecnicos
            (fk_propriedade_rural, fk_tecnico)
            VALUES(
                '{$id_propriedade}',
                '{$id_tecnico}'
            )
        ";
        $this->conn->execute($query);
    }

    function select_endereco_primeira_propriedade_agricultor(){
        $query = "
            SELECT
                fk_endereco
            FROM propriedades_rurais
            WHERE TRUE
                AND fk_agricultor = 21
            LIMIT 1
        ";
        $this->conn->fetch_attr($query, 'fk_endereco');
    }
    /**
     * Usado durante o login para descobrir
     * qual é a propriedade do usuário que está logando
     */
//    function select_propriedades_usuario_light($id_usuario) {
//        $query = "
//            SELECT
//                id_propriedade_rural
//            FROM propriedades_rurais
//            WHERE TRUE
//                AND fk_usuario_responsavel = '{$id_usuario}'
//        ";
//        return $this->conn->fetch_all($query);
//    }

//    function select_propriedades_usuario($id_usuario) {
//        $query = "
//            SELECT
//                id_propriedade_rural,
//                lat,
//                lng,
//                estados.nome AS estado,
//                municipios.nome AS municipio
//            FROM propriedades_rurais
//            INNER JOIN enderecos ON fk_endereco = id_endereco
//            INNER JOIN estados ON fk_estado = id_estado
//            INNER JOIN municipios ON fk_municipio = id_municipio
//            WHERE TRUE
//                AND fk_usuario_responsavel = '{$id_usuario}'
//        ";
//        return $this->conn->fetch_all($query);
//    }

    function getColetivo() {
        return $this->coletivo;
    }


}
