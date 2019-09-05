<?php
$id_compra = $_POST['id_compra'];

$o_compra = new Compras();
$compra   = $o_compra->select_compra_especificada($id_compra);

$o_pedidos = new Pedidos();
$pedidos   = $o_pedidos->select_todos_produtos_compra($id_compra);

$o_agricultor    = new Agricultor();
$nome_agricultor = $o_agricultor->select_agricultor_especificado($compra['fk_produtor']);

$o_pagamento = new PagamentoAgricultor();
$pagamento   = $o_pagamento->select_pagamento_especifico($id_compra);

/*
  COMPRA
  Status
  1 - Compra feita e confirmada
  2 - Compra confirmada mas precisa buscar os produtos
  3 - Compra cancelada (Estornada)
 */
?> 
<table class="table table-bordered table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center"> ID </th>
            <th class="text-center"> Status </th>
            <th class="text-center"> Produtor </th>
            <th class="text-center"> Operador </th>
            <th class="text-center"> Produto </th>
            <th class="text-center"> Tipo </th>
            <th class="text-center"> QTD </th>
            <th class="text-center"> Valor </th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($pedidos as $pedido) {
            $o_produto = new Produto();
            $item = $o_produto->select_produto($pedido['fk_produto']);

            $o_usuario    = new Usuario();
            $nome_usuario = $o_usuario->select_nome_usuario($compra['fk_operador']);
            ?>
            <tr>
                <td class="text-center">
                    <?php echo $pedido['id_pedido']; ?>
                </td>

                <td class="text-center">
                    <?php
                    if ($pedido['status'] == 1) {
                        echo "Ativo";
                    } else {
                        echo "Cancelado";
                    }
                    ?>
                </td>

                <td class="text-center">
                    <?php echo $nome_agricultor['nome']; ?>
                </td>

                <td class="text-center">
                    <?php echo $nome_usuario['nome']; ?>
                </td>

                <td class="text-center">
                    <?php echo $item['nome']; ?>
                </td>

                <td class="text-center">
                    <?php echo MEDIDAS_PRODUTOS::getMedidasProd($pedido['produto_medida']); ?>
                </td>

                <td class="text-center">
                    <?php echo $pedido['qtd']; ?>
                </td>

                <td class="text-center">
                    <?php echo "R$ ".MOEDA::moeda_mysql_para_br($pedido['valor']); ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
                Dados Financeiros
            </h3>
        </div>
    </div>
</div>
<table class="table table-bordered table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center"> Data de Pagamento </th>
            <th class="text-center"> Saldo Total </th>
            <th class="text-center"> Saldo Atual </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">  
                <?php echo DATE::mysql_to_date($pagamento['data_pagamento']); ?>
            </td>

            <td class="text-center">
                <?php echo "R$ ".MOEDA::moeda_mysql_para_br($pagamento['valor_total']); ?>
            </td>

            <td class="text-center">
                <?php echo "R$ ".MOEDA::moeda_mysql_para_br($pagamento['valor_atual']); ?>
            </td>
        </tr>
    </tbody>
</table>

<!-- Se o status for 2 precisa ir buscar o produto -->
<?php if ($compra['status'] == 2) { ?>
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Transporte
                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            <div class="alert-text">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
    </div>

<?php } ?>