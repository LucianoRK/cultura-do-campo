<?php
$o_filiado = new Filiado();

$a_filiado = $o_filiado->select_todos_filiados_ativos();
?>

<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Filiados cadastrados
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">	
        <table class="table datatable table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome fantasia</td>
                    <td>CNPJ</td>
                    <td>Coletivo</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($a_filiado) { ?>

                    <?php foreach ($a_filiado as $value) { ?>
                        <tr>
                            <td><?php echo $value['id_filiado']; ?></td>
                            <td><?php echo $value['nome_fantasia']; ?></td>
                            <td><?php echo $value['cnpj']; ?></td>
                            <td><?php echo $value['coletivo']; ?></td>
                        </tr>
                    <?php } ?>

                <?php } ?>
            </tbody>
        </table>
    </div>

</div>


<script>
    $(document).ready(function () {
        $(".datatable").DataTable();
    });
</script>


