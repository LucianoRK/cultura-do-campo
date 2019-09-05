<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatrizFiscal
 *
 * @author Notheros
 */
class MatrizFiscal
{
    private $conn;
    private $crt;
    private $inscricaoMunicipal;
    private $inscricaoEstadual;

    function __construct()
    {
        $this->conn = DB::get_instance();
    }

    /**
     * Durante o cadastro do filiado
     */
    function insert_matriz_fiscal($id_filiado)
    {
        $query = "
            INSERT INTO matrizes_fiscais
            (
                fk_filiado
            )
            VALUES (
                '{$id_filiado}'
            )
        ";
        $this->conn->execute($query);
    }

    function select_matriz_fiscal_filiado($id_filiado)
    {
        $query = "
            SELECT
                fk_cnae,
                fk_regime_tributacao,
                crt,
                inscricao_municipal,
                inscricao_estadual
            FROM matrizes_fiscais
            WHERE fk_filiado = '{$id_filiado}'
        ";
        return $this->conn->fetch($query);
    }

    function update_matriz_fiscal($id_filiado, $id_cnae, $id_regime_tributacao)
    {
        $query = "
            UPDATE matrizes_fiscais
            SET
                fk_cnae = '{$id_cnae}',
                fk_regime_tributacao = '{$id_regime_tributacao}',
                crt = '{$this->getCrt()}',
                inscricao_municipal = '{$this->getInscricaoMunicipal()}',
                inscricao_estadual = '{$this->getInscricaoEstadual()}'
            WHERE fk_filiado = '{$id_filiado}'
        ";
        $this->conn->execute($query);
    }

    function select_cnaes()
    {
        $query = "
            SELECT
                id_cnae,
                codigo_cnae,
                desc_cnae
            FROM cnae
        ";
        return $this->conn->fetch_all($query);
    }

    function select_regimes_tributacao()
    {
        $query = "
            SELECT
                id_regime,
                descricao
            FROM regimes_tributacao
        ";
        return $this->conn->fetch_all($query);
    }

    function getCrt()
    {
        return $this->crt;
    }

    function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }

    function getInscricaoEstadual()
    {
        return $this->inscricaoEstadual;
    }

    function setCrt($crt)
    {
        if (!$crt || ($crt >= 1 && $crt <= 3)) {

            $this->crt = $crt;
        } else {
            APP::return_response(false, "Código de regime tributário (CRT) inválido");
        }
    }

    function setInscricaoMunicipal($inscricaoMunicipal)
    {
        if (!$inscricaoMunicipal || is_numeric($inscricaoMunicipal)) {
            $this->inscricaoMunicipal = $inscricaoMunicipal;
        } else {
            APP::return_response(false, "INSCRIÇÃO MUNICIPAL inválida");
        }
    }

    function setInscricaoEstadual($inscricaoEstadual)
    {
        if (!$inscricaoEstadual || is_numeric($inscricaoEstadual)) {
            $this->inscricaoEstadual = $inscricaoEstadual;
        } else {
            APP::return_response(false, "INSCRIÇÃO ESTADUAL inválida");
        }
    }
}