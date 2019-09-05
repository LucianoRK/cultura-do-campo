<?php

class Endereco {

    private $numero;
    private $complemento;
    private $logradouro;
    private $cep;
    private $bairro;
    private $municipio;
    private $estado;
    private $lat;
    private $lng;
    private $comunidade;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    public function estados() {
        $query = "SELECT * FROM estados";
        return $this->conn->fetch_all($query);
    }

    public function municipios() {
        $query = "SELECT id_municipio, nome, uf FROM municipios";
        return $this->conn->fetch_all($query);
    }

    public function get_id_from_uf($uf) {
        $query = "SELECT id_estado FROM estados WHERE uf = '{$uf}'";
        $estado = $this->conn->fetch($query);
        if (isset($estado['id_estado']) && $estado['id_estado'] > 0) {
            return $estado['id_estado'];
        } else {
            return false;
        }
    }

    public function get_nome_from_uf($uf) {
        $query = "SELECT nome FROM estados WHERE uf = '{$uf}'";
        $estado = $this->conn->fetch($query);
        if ($estado) {
            return $estado['nome'];
        } else {
            return false;
        }
    }

    public function get_id_from_nome_municipio($nome) {
        $query = "SELECT id_municipio FROM municipios WHERE nome = '{$nome}'";
        $municipio = $this->conn->fetch($query);
        if (isset($municipio['id_municipio']) && $municipio['id_municipio'] > 0) {
            return $municipio['id_municipio'];
        } else {
            return false;
        }
    }

    function insertEndereco() {
        $query = "
            INSERT INTO enderecos
             (
                fk_estado,
                fk_municipio, 
                cep,
                bairro, 
                logradouro, 
                numero,
                complemento,
                lat,
                lng,
                comunidade
            )
            VALUES (
                '{$this->get_estado()}',
                '{$this->get_municipio()}',
                '{$this->get_cep()}',
                '{$this->get_bairro()}',
                '{$this->get_logradouro()}',
                '{$this->get_numero()}',
                '{$this->get_complemento()}',
                '{$this->get_lat()}',
                '{$this->get_lng()}',
                '{$this->get_comunidade()}'
             )";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function updateEndereco($id_endereco) {
        $query = "
            UPDATE enderecos
              SET
                fk_estado = '{$this->get_estado()}',
                fk_municipio = '{$this->get_municipio()}',
                cep = '{$this->get_cep()}',
                bairro = '{$this->get_bairro()}',
                logradouro = '{$this->get_logradouro()}',
                numero = '{$this->get_numero()}',
                complemento = '{$this->get_complemento()}',
                lat = '{$this->get_lat()}',
                lng = '{$this->get_lng()}',
                comunidade = '{$this->get_comunidade()}'
            WHERE TRUE
                AND id_endereco = '$id_endereco'
                AND ativo = '1'
            ";
        $this->conn->execute($query);
    }


    function get_lat() {
        return $this->lat;
    }

    function get_cep() {
        return $this->cep;
    }

    function get_lng() {
        return $this->lng;
    }

    function get_numero() {
        return $this->numero;
    }

    function get_complemento() {
        return $this->complemento;
    }

    function get_logradouro() {
        return $this->logradouro;
    }

    function get_bairro() {
        return $this->bairro;
    }

    function get_municipio() {
        return $this->municipio;
    }

    function get_estado() {
        return $this->estado;
    }

    function set_cep($cep, $required = true) {
        if ($required == false || $cep) {
            $this->cep = STRINGS::limpar($cep);
        } else {
            APP::return_response(false, "Favor informar o CEP");
        }
    }

    function set_lat($lat) {
        if (VALIDA::isValidLatitude($lat)) {
            $this->lat = STRINGS::limpar($lat);
        } else {
            APP::return_response(false, "(LAT) Latitude inválida");
        }
    }

    function set_lng($lng) {
        if (VALIDA::isValidLongitude($lng)) {
            $this->lng = STRINGS::limpar($lng);
        } else {
            APP::return_response(false, "(LNG) Longitude inválida");
        }
    }

    function set_numero($numero, $required = true) {
        if ($required == false || $numero) {
            $this->numero = STRINGS::limpar($numero);
        } else {
            APP::return_response(false, "Favor informar o número do imóvel");
        }
    }

    function set_complemento($complemento) {
        $this->complemento = STRINGS::limpar($complemento);
    }

    function set_logradouro($logradouro, $required = true) {
        if ($required == false || $logradouro) {
            $this->logradouro = STRINGS::limpar($logradouro);
        } else {
            APP::return_response(false, "Favor informar o LOGRADOURO");
        }
    }

    function set_bairro($bairro) {
        $this->bairro = STRINGS::limpar($bairro);
    }

    function set_municipio($municipio) {
        if ($municipio) {
            $this->municipio = STRINGS::limpar($municipio);
        } else {
            APP::return_response(false, "Favor informar a CIDADE");
        }
    }

    function set_estado($estado) {
        if ($estado) {
            $this->estado = STRINGS::limpar($estado);
        } else {
            APP::return_response(false, "Favor informar o ESTADO");
        }
    }

    function get_comunidade() {
        return $this->comunidade;
    }

    function set_comunidade($comunidade) {
        $this->comunidade = STRINGS::limpar($comunidade);
    }

    function select_endereco($id_endereco) {
        $query = "
            SELECT 
                cep,
                bairro,
                logradouro,
                numero,
                complemento,
                estados.nome AS estado,
                municipios.nome AS municipio,
                codigo_uf,
                municipios.codigo AS codigo_municipio,
                estados.uf AS sigla_estado,
                cep
            FROM 
                enderecos 
            INNER JOIN estados ON fk_estado = id_estado
            INNER JOIN municipios ON fk_municipio = id_municipio
            WHERE TRUE 
                AND id_endereco = '{$id_endereco}' 
                AND ativo = '1' 
        ";
        return $this->conn->fetch($query);
    }

}
