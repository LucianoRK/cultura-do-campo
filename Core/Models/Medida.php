<?php

class Medida
{
    private $conn;
    private $idUnidade;

    function __construct()
    {
        $this->conn = DB::get_instance();
    }

    function select_unidades_medida()
    {
        $query = "
                SELECT id_unidade, descricao
                FROM produtos_medidas
                WHERE ativo = 1
            ";
        return $this->conn->fetch_all($query);
    }

    function is_unidade_valida($idUnidade)
    {
        $query = "
                SELECT id_unidade
                FROM produtos_medidas
                WHERE TRUE
                    AND ativo = 1
                    AND id_unidade = '{$idUnidade}'
            ";
        return $this->conn->fetch($query);
    }

    function select_medida_especificada($id_medida)
    {
        $query = "
                SELECT descricao
                FROM medidas
                WHERE id_medida = '{$id_medida}'
            ";
        return $this->conn->fetch_attr($query, 'descricao');
    }

    function getIdUnidade()
    {
        return $this->idUnidade;
    }

    function setIdUnidade($idUnidade)
    {
        $unidade = $this->is_unidade_valida($idUnidade);
        if ($unidade) {
            $this->idUnidade = $idUnidade;
        } else {
            APP::return_response(false,
                "A unidade de medida selecionada é inválida");
        }
    }
}