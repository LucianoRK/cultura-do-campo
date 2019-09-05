<?php
$o_compras  = new Compras();
$id_filiado = SESSION::get_id_filiado();
$compras    = $o_compras->select_todas_compras_filiado($id_filiado);

/*
  COMPRA
  Status
  1 - Compra feita e confirmada
  2 - Compra confirmada mas precisa buscar os produtos
 *  0 - Compra cancelada (Estornada)
 */
?>
<table class="table table-hover table-sm ptable" id="table_compras_realizadas">
    <thead>
        <tr>
            <th class="text-center font-weight-bold"> ID </th>
            <!--<th class="text-center"> Detalhe </th>-->
            <th class="text-center font-weight-bold"> Ações </th>
            <th class="text-center font-weight-bold"> Status </th>
            <th class="text-center font-weight-bold"> Produtor </th>
            <th class="text-center font-weight-bold"> Valor Total </th>
            <!--<th class="text-center"> NF </th>-->
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($compras as $compra) {
            $o_agricultor    = new Agricultor();
            $nome_agricultor = $o_agricultor->select_agricultor_especificado($compra['fk_produtor']);
            ?>
            <tr class="tr_compras_realizadas">
                <td class="text-center font-weight-bold">
                    #<?php echo $compra['id_compra']; ?>
                    <input type="hidden" name="id_compra_hidden" id="id_compra_hidden" value="<?php echo $compra['id_compra']; ?>" >
                </td>
    <!--                <td class="text-center">-->
                    <!--<button type="button" id_compra="<?php echo $compra['id_compra']; ?>" class="btn btn-primary btn-sm detalhe"> <span class="flaticon-medical btn-sm"> </span></button>-->
                <!--</td>-->
                <td width='15%' class="text-center">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-success btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Opções
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start">
                            <a class="dropdown-item detalhe pointer" id_compra="<?php echo $compra['id_compra']; ?>"><i class="la  la-info "></i> Ver detalhes</a>
                            <?php if (!$compra['nf']) { ?>
                                <a class="dropdown-item pointer" href="financeiro/nfe/compra/<?php echo $compra['id_compra']; ?>" target="_blank"><i class="la  la-folder-o"></i> Gerar Danfe</a>
                            <?php } ?>
                            <?php
                            if ($compra['status'] != 0) {
                                ?>
                                <a class="dropdown-item pointer" id="imprimir_recibo" ><i class="la la-book"></i> Exibir recido</a>
                                <a class="dropdown-item pointer" ><i class="la la-remove text-danger"></i> Estornar compra</a>
                            <?php } ?>
                            <?php
                            if ($compra['status'] == 2) {
                                ?>
                                <a id="efetivar_compra" id_compra="<?php echo $compra['id_compra']; ?>" class="dropdown-item pointer"><i class="la la-remove text-danger"></i> Efetivar compra</a>
                            <?php } ?>

                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <?php
                    if ($compra['status'] == 1) {
                        echo "Confirmada";
                    } else if ($compra['status'] == 2) {
                        echo "Aguardando chegada";
                    } else {
                        echo "Compra cancelada";
                    }
                    ?>
                </td>

                <td class="text-center">
                    <?php echo STRINGS::proper_case($nome_agricultor['nome']); ?>
                </td>

                <td class="text-center" style='color: blue'>
                    <?php echo "R$ ".MOEDA::moeda_mysql_para_br($compra['valor_total']); ?>
                </td>



            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function efetivar_compra() {

        $("#table_compras_realizadas").DataTable();

        $("#efetivar_compra").off("click");
        $("#efetivar_compra").on("click", function () {
            var id_compra = $("#efetivar_compra").attr('id_compra');

            if (confirm("Deseja efetivar esta compra ?")) {
                $.ajax({
                    type: "post",
                    url: "efetivar/compra",
                    data: {id_compra: id_compra},
                    success: function (response) {
                        lerResposta(response, listar_compras);
                    }
                });
            }
        });
    }

    function abrir_compra_detalhada() {
        $(".detalhe").on("click", function () {
            var id_compra = $(this).attr('id_compra');

            window.open(
                    'detalhe/compra/' + id_compra,
                    'detalhe',
                    "width=1024, height=624, top=250, left=250, scrollbars=ye,"
                    );
        });
    }

    function imprimir_recibo() {
        $("#imprimir_recibo").on("click", function () {
            let id_compra = $("#id_compra_hidden").val();
            window.location.href = "recibo/" + id_compra;
        });
    }

    $(document).ready(function () {
        efetivar_compra();
        abrir_compra_detalhada();
        imprimir_recibo();
    });
</script>