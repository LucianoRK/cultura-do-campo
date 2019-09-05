<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Filiado
 *
 * @author Notheros
 */
class Filiado
{
    private $conn;
    private $nomeFantasia;
    private $razaoSocial;
    private $cnpj;
    private $descontoFundoRural;
    private $fundoCapital;
    private $cotaCapital;

    function __construct()
    {
        $this->conn = DB::get_instance();
    }

    function insert_filiado($id_coletivo, $id_endereco)
    {
        $query = "
            INSERT INTO
                filiados
            (
                fk_endereco,
                fk_coletivo,
                nome_fantasia,
                razao_social,
                cnpj,
                desconto_fundo_rural,
                cota_capital,
                fundo_capital
            )
            VALUES (
                '{$id_endereco}',
                '{$id_coletivo}',
                '{$this->getNomeFantasia()}',
                '{$this->getRazaoSocial()}',
                '{$this->getCnpj()}',
                '{$this->getDescontoFundoRural()}',
                '{$this->getCotaCapital()}',
                '{$this->getFundoCapital()}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function insert_vinculo_usuario_filiado($id_usuario, $id_filiado)
    {
        $query = "
            INSERT INTO 
                xref_usuarios_filiados
            (fk_usuario, fk_filiado)
            VALUES(
                '{$id_usuario}',
                '{$id_filiado}'
            )
        ";
        $this->conn->execute($query);
    }

    function select_informacoes_filiado_especificado($id_filiado)
    {
        $query = "
            SELECT 
                id_filiado,
                nome_fantasia,
                cnpj,
                fk_endereco,
                inscricao_estadual,
                razao_social
            FROM filiados
            WHERE TRUE
                AND id_filiado = '{$id_filiado}'
        ";
        return $this->conn->fetch($query);
    }

    function select_todos_filiados_ativos()
    {
        $query = "
            SELECT 
                id_filiado,
                nome_fantasia,
                cnpj,
                descricao AS coletivo
            FROM filiados
            INNER JOIN coletivos ON fk_coletivo = id_coletivo
            WHERE TRUE
                AND filiados.ativo = 1
        ";
        return $this->conn->fetch_all($query);
    }

    /**
     * Usado durante o login para descobrir
     * qual é o filiado do usuário que está logando
     */
    function select_filiado_usuario($id_usuario)
    {
        $query = "
            SELECT
                id_filiado, nome_fantasia
            FROM filiados
            INNER JOIN xref_usuarios_filiados ON id_filiado = fk_filiado
            WHERE TRUE
                AND fk_usuario = '{$id_usuario}'
        ";
        return $this->conn->fetch($query);
    }

    function get_cota_capital_atual($id_filiado)
    {
        $query = "
            SELECT
                cota_capital
            FROM filiados
            WHERE TRUE
                AND id_filiado = '{$id_filiado}'
        ";
        return $this->conn->fetch_attr($query, 'cota_capital');
    }

    function get_id_endereco_filiado($id_filiado)
    {
        $query = "
            SELECT
                fk_endereco
            FROM filiados
            WHERE TRUE
                AND id_filiado = '{$id_filiado}'
        ";
        return $this->conn->fetch_attr($query, 'fk_endereco');
    }

    function update_nome_razao_cnpj_filiado($id_filiado)
    {
        $query = "
            UPDATE filiados
            SET
                nome_fantasia = '{$this->getNomeFantasia()}',
                razao_social = '{$this->getRazaoSocial()}',
                cnpj = '{$this->getCnpj()}'
            WHERE id_filiado = '{$id_filiado}'
        ";
        return $this->conn->execute($query);
    }

    function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    function getCnpj()
    {
        return $this->cnpj;
    }

    function setNomeFantasia($nomeFantasia)
    {
        if ($nomeFantasia) {
            $this->nomeFantasia = $nomeFantasia;
        } else {
            APP::return_response(false, "Informe o nome fantasia");
        }
    }

    function setRazaoSocial($razaoSocial)
    {
        if ($razaoSocial) {
            $this->razaoSocial = $razaoSocial;
        } else {
            APP::return_response(false, "Informe a razão social");
        }
    }

    function setCnpj($cnpj)
    {
        if (VALIDA::isCNPJ($cnpj)) {
            $this->cnpj = $cnpj;
        } else {
            APP::return_response(false, "Informe um CNPJ válido");
        }
    }

    function getDescontoFundoRural()
    {
        return $this->descontoFundoRural;
    }

    function getFundoCapital()
    {
        return $this->fundoCapital;
    }

    function getCotaCapital()
    {
        return $this->cotaCapital;
    }

    function setDescontoFundoRural($descontoFundoRural)
    {
        if (is_numeric($descontoFundoRural) && $descontoFundoRural > 0) {
            $this->descontoFundoRural = $descontoFundoRural;
        } else {
            APP::return_response(false, "FUNDO RURAL deve ser maior que zero");
        }
    }

    function setFundoCapital($fundoCapital)
    {
        if (is_numeric($fundoCapital) && $fundoCapital >= 0) {
            $this->fundoCapital = $fundoCapital;
        } else {
            APP::return_response(false, "FUNDO CAPITAL deve ser igual ou maior que zero");
        }
    }

    function setCotaCapital($cotaCapital)
    {
        if ($cotaCapital) {
            $this->cotaCapital = MOEDA::reais_to_centavos($cotaCapital);
        } else {
            APP::return_response(false, "Informe a COTA CAPITAL");
        }
    }
}