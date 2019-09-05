<?php
require 'Library/Nfephp/vendor/autoload.php';

$nfe = new NFePHP\NFe\Make();

$std         = new stdClass();
$std->versao = '3.10';
$nfe->taginfNFe($std);

$std           = new stdClass();
$std->cUF      = 41;
$std->cNF      = '80070008';
$std->natOp    = 'VENDA';
$std->indPag   = 0;
$std->mod      = 55;
$std->serie    = 1;
$std->nNF      = 2;
$std->dhEmi    = '2018-02-06T20:48:00-02:00';
$std->dhSaiEnt = '2018-02-06T20:48:00-02:00';
$std->tpNF     = 0;
$std->idDest   = 1;
$std->cMunFG   = 3518800;
$std->tpImp    = 1;
$std->tpEmis   = 1;
$std->cDV      = 2;
$std->tpAmb    = 2; // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
$std->finNFe   = 1;
$std->indFinal = 0;
$std->indPres  = 0;
$std->procEmi  = '3.10.31';
$std->verProc  = 1;
$nfe->tagide($std);

$std        = new stdClass();
$std->xNome = 'Empresa Sácarai';
$std->IE    = '6564344535';
$std->CRT   = 3;
$std->CNPJ  = '78767865000156';
$nfe->tagemit($std);

$std          = new stdClass();
$std->xLgr    = "Rua Teste";
$std->nro     = '203';
$std->xBairro = 'Centro';
$std->cMun    = '4317608';
$std->xMun    = 'Palmeira';
$std->UF      = 'PR';
$std->CEP     = '955500-000';
$std->cPais   = '1058';
$std->xPais   = 'BRASIL';
$nfe->tagenderEmit($std);

$std            = new stdClass();
$std->xNome     = 'Empresa destinatário teste';
$std->indIEDest = 1;
$std->IE        = '6564344535';
$std->CNPJ      = '78767865000156';
$nfe->tagdest($std);

$std          = new stdClass();
$std->xLgr    = "Rua Teste";
$std->nro     = '203';
$std->xBairro = 'Centro';
$std->cMun    = '4317608';
$std->xMun    = 'Palmeira';
$std->UF      = 'PR';
$std->CEP     = '955500-000';
$std->cPais   = '1058';
$std->xPais   = 'BRASIL';
$nfe->tagenderDest($std);

$std          = new stdClass();
$std->item    = 1;
$std->cProd   = '0001';
$std->xProd   = "Produto teste";
$std->NCM     = '66554433';
$std->CFOP    = '5102';
$std->uCom    = 'PÇ';
$std->qCom    = '1.0000';
$std->vUnCom  = '10.99';
$std->vProd   = '10.99';
$std->uTrib   = 'PÇ';
$std->qTrib   = '1.0000';
$std->vUnTrib = '10.99';
$std->indTot  = 1;
$nfe->tagprod($std);

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
$std->marca = 'SÁCARAI';
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
$std->nDup  = '100';
$std->dVenc = '2019-08-22';
$std->vDup  = 11.03;
$nfe->tagdup($std);

$xml = $nfe->getXML();

///


require_once 'Library/Danfe/vendor/autoload.php';

use NFePHP\DA\NFe\Danfe;

//use NFePHP\DA\Legacy\FilesFolders;
//$xml = 'xml/mod55-nfe.xml';
$docxml = $xml;
$logo   = 'data://text/plain;base64,'.base64_encode(file_get_contents('Public/Images/Logo/nfe.jpg'));
try {
    $danfe = new Danfe($docxml, 'P', 'A4', "", 'I', '');
    $id    = $danfe->montaDANFE();
    $pdf   = $danfe->render();
    //o pdf porde ser exibido como view no browser
    //salvo em arquivo
    //ou setado para download forçado no browser 
    //ou ainda gravado na base de dados
    header('Content-Type: application/pdf');
    echo $pdf;
} catch (InvalidArgumentException $e) {
    echo "Ocorreu um erro durante o processamento :".$e->getMessage();
}   
