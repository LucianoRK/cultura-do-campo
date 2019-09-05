<?php
$o_agricultor = new Agricultor();
$a_agricultores = $o_agricultor->select_agricultores_ativos();
?>


<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Agricultores cadastrados
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">	
        <table id="agricultores_table" class="table datatable table-hover" style="border: 1px solid rgba(0,0,0,.10)">
            <thead>
                <tr>
                    <td>Usuário</td>
                    <td>Nome</td>
                    <td>CPF</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($a_agricultores) { ?>
                    <?php foreach ($a_agricultores as $value) { ?>
                        <tr href="usuarios/agricultor/<?php echo $value['id_usuario']; ?>/info" class="pointer">
                            <td><?php echo $value['id_usuario']; ?></td>
                            <td><?php echo $value['nome']; ?></td>
                            <td><?php echo $value['cpf']; ?></td>
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

        $("#agricultores_table tbody").on("click", "tr", function () {
            window.location = $(this).attr("href");
        });


    });
</script>