<?php
require 'Library/Nfephp/vendor/autoload.php';

$id_compra = $_GET['id_compra'];

$o_compra      = new Compras();
$o_endereco    = new Endereco();
$o_filiado     = new Filiado();
$o_agricultor  = new Agricultor();
$o_propriedade = new PropriedadeRural();
$o_pedidos     = new Pedidos();
$o_produto     = new Produto();
$o_medida      = new Medida();

/**
 * Dados da compra
 */
$compra                 = $o_compra->select_compra_especificada($id_compra);
/**
 * Items da compra
 */
$pedidos                = $o_pedidos->select_todos_produtos_compra($id_compra);
/**
 * Dados da cooperativa (filiado que comprou)
 */
$filiado                = $o_filiado->select_informacoes_filiado_especificado($compra['fk_filiado']);
/**
 * Endereço do filiado
 */
$end_filiado            = $o_endereco->select_endereco($filiado['fk_endereco']);
/**
 * Dados do agricultor (quem vendeu)
 */
$agricultor             = $o_agricultor->select_agricultor_especificado($compra['fk_produtor']);
/**
 * Endereço do produtor (primeira propriedade encontrada)
 */
$id_endereco_agricultor = $o_propriedade->select_endereco_primeira_propriedade_agricultor($compra['fk_produtor']);
$end_agricultor         = $o_endereco->select_endereco($id_endereco_agricultor);




$nfe = new NFePHP\NFe\Make();

$std         = new stdClass();
$std->versao = '3.10';
$nfe->taginfNFe($std);

$std           = new stdClass();
$std->cUF      = $end_filiado['codigo_uf'];
$std->cNF      = $id_compra.$filiado['id_filiado'].$agricultor['id_agricultor']; //id_compra + id_filiado + id_agricultor
$std->natOp    = 'COMPRA';
$std->indPag   = 0;
$std->mod      = 55;
$std->serie    = 1; // nao entendi
$std->nNF      = 2; // nao entendi
$std->dhEmi    = DATE::timestamp_to_utc($compra['data']);
$std->dhSaiEnt = DATE::timestamp_to_utc($compra['data']);
$std->tpNF     = 0;
$std->idDest   = 1;
$std->cMunFG   = $end_filiado['codigo_municipio'];
$std->tpImp    = 1;
$std->tpEmis   = 1;
$std->cDV      = $id_compra; // nao entendi
$std->tpAmb    = 2; // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
$std->finNFe   = 1;
$std->indFinal = 0;
$std->indPres  = 0;
$std->procEmi  = 0;
$std->verProc  = 1;
$nfe->tagide($std);

$std        = new stdClass();
$std->xNome = $filiado['nome_fantasia'];
$std->IE    = $filiado['inscricao_estadual'];
$std->CRT   = 3; //nao entendi
$std->CNPJ  = $filiado['cnpj'];
$nfe->tagemit($std);

$std          = new stdClass();
$std->xLgr    = $end_filiado['logradouro'];
$std->nro     = $end_filiado['numero'];
$std->xBairro = $end_filiado['bairro'];
$std->cMun    = $end_filiado['codigo_municipio'];
$std->xMun    = $end_filiado['municipio'];
$std->UF      = $end_filiado['sigla_estado'];
$std->CEP     = $end_filiado['cep'];
$std->cPais   = '1058';
$std->xPais   = 'BRASIL';
$nfe->tagenderEmit($std);

$std        = new stdClass();
$std->xNome = $agricultor['nome'];
//$std->indIEDest = 1; // nao entendi
//$std->IE = '6564344535'; // nao entendi
$std->CNPJ  = '78767865000156';
$nfe->tagdest($std);

$std          = new stdClass();
$std->xLgr    = $end_agricultor['logradouro'];
$std->nro     = $end_agricultor['numero'];
$std->xBairro = $end_agricultor['bairro'];
$std->cMun    = $end_agricultor['codigo_municipio'];
$std->xMun    = $end_agricultor['municipio'];
$std->UF      = $end_agricultor['sigla_estado'];
$std->CEP     = $end_agricultor['cep'];
$std->cPais   = '1058';
$std->xPais   = 'BRASIL';
$nfe->tagenderDest($std);



foreach ($pedidos as $key => $item) {
    $produto = $o_produto->select_produto($item['fk_produto']);
    $medida  = $o_medida->select_medida_especificada($item['produto_medida']);

    $std          = new stdClass();
    $std->item    = $key + 1;
    $std->cProd   = $item['fk_produto'];
    $std->xProd   = $produto['ncm_descricao'];
    $std->NCM     = $produto['ncm_codigo'];
    $std->CFOP    = '1102';
    $std->uCom    = $medida;
    $std->qCom    = $item['qtd'];
    $std->vUnCom  = '10.99';
    $std->vProd   = '10.99';
    $std->uTrib   = $medida;
    $std->qTrib   = '1.0000';
    $std->vUnTrib = '10.99';
    $std->indTot  = 1;
    $nfe->tagprod($std);
}

$std           = new stdClass();
$std->item     = 1;
$std->vTotTrib = 10.99;
$nfe->tagimposto($std);

$std        = new stdClass();
$std->item  = 1;
$std->orig  = 0;
$std->CST   = '00';
$std->modBC = 0;
$std->vBC   = 0.20;
$std->pICMS = '18.0000';
$std->vICMS = '0.04';
$nfe->tagICMS($std);

$std       = new stdClass();
$std->item = 1;
$std->cEnq = '999';
$std->CST  = '50';
$std->vIPI = 0;
$std->vBC  = 0;
$std->pIPI = 0;
$nfe->tagIPI($std);

$std       = new stdClass();
$std->item = 1;
$std->CST  = '07';
$std->vBC  = 0;
$std->pPIS = 0;
$std->vPIS = 0;
$nfe->tagPIS($std);

$std          = new stdClass();
$std->item    = 1;
$std->vCOFINS = 0;
$std->vBC     = 0;
$std->pCOFINS = 0;
$nfe->tagCOFINSST($std);

$std             = new stdClass();
$std->vBC        = 0.20;
$std->vICMS      = 0.04;
$std->vICMSDeson = 0.00;
$std->vBCST      = 0.00;
$std->vST        = 0.00;
$std->vProd      = 10.99;
$std->vFrete     = 0.00;
$std->vSeg       = 0.00;
$std->vDesc      = 0.00;
$std->vII        = 0.00;
$std->vIPI       = 0.00;
$std->vPIS       = 0.00;
$std->vCOFINS    = 0.00;
$std->vOutro     = 0.00;
$std->vNF        = 11.03;
$std->vTotTrib   = 0.00;
$nfe->tagICMSTot($std);

$std           = new stdClass();
$std->modFrete = 1;
$nfe->tagtransp($std);


$std        = new stdClass();
$std->item  = 1;
$std->qVol  = 2;
$std->esp   = 'caixa';
$std->marca = 'marca';
$std->nVol  = '11111';
$std->pesoL = 10.00;
$std->pesoB = 11.00;
$nfe->tagvol($std);

$std        = new stdClass();
$std->nFat  = '100';
$std->vOrig = 100;
$std->vLiq  = 100;
$nfe->tagfat($std);

$std        = new stdClass();
$std->nDup  = '100'; // que diabos é numero da duplicada??
$std->dVenc = '2019-05-22';
$std->vDup  = 11.03;
$nfe->tagdup($std);

$xml = $nfe->getXML();



require_once 'Library/Danfe/vendor/autoload.php';
use NFePHP\DA\NFe\Danfe;
//use NFePHP\DA\Legacy\FilesFolders;
//$xml = 'xml/mod55-nfe.xml';
$docxml = $xml;
$logo = 'data://text/plain;base64,'. base64_encode(file_get_contents('Public/Images/Logo/nfe.jpg'));
try {
    $danfe = new Danfe($docxml, 'P', 'A4', "", 'I', '');
    $id = $danfe->montaDANFE();
    $pdf = $danfe->render();
    //o pdf porde ser exibido como view no browser
    //salvo em arquivo
    //ou setado para download forçado no browser
    //ou ainda gravado na base de dados
    header('Content-Type: application/pdf');
    echo $pdf;
} catch (InvalidArgumentException $e) {
    echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
}

