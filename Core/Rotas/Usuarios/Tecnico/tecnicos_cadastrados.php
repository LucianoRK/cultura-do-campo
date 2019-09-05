<?php
$o_tecnico = new Tecnico();
$a_tecnicos = $o_tecnico->selectTecnicosAtivos();
?>


<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Técnicos cadastrados
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">	
        <table class="table datatable table-sm">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome completo</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($a_tecnicos) { ?>
                    <?php foreach ($a_tecnicos as $value) { ?>
                        <tr>
                            <td>U<?php echo $value['id_usuario']; ?>-T<?php echo $value['id_tecnico']; ?></td>
                            <td><?php echo $value['nome']; ?></td>
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