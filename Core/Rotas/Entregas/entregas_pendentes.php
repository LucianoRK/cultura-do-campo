<?php
$o_entrega = new Entrega();
$array_entregas = $o_entrega->select_minhas_entregas_pendentes();
?>


<section class="page-content animated ">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Entregas pendentes
                </div>
            </div>
            <div class="card-body">
                <table id="entregas-table" class="table table-striped table-bordered table-light block-el ">

                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center"></th>

                            <th class="text-center font-weight-bold">Acesso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($array_entregas) { ?>

                            <?php foreach ($array_entregas as $value) { ?>
                                <tr class="pointer" id="<?php echo $value['id_entrega']; ?>">
                                    <td class="text-center"><?php echo $value['id_entrega']; ?></td>
                                    <td class="text-center"><?php echo $value['data_saida']; ?></td>
                                    <td class="text-center"><?php echo $value['status']; ?></td>
                                </tr>
                            <?php } ?>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>





<script>
    $(document).ready(function () {
        $('#entregas-table').DataTable({
            "order": [],
            "paging": false
        });


        $("#entregas-table tr").on("click", function () {
            var id_entrega = $(this).attr("id");
            window.location = "entregas/" + id_entrega + "/detalhes";
        });
    });
</script>