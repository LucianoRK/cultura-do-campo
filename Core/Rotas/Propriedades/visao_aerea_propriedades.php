<?php

$o_propriedade = new PropriedadeRural();
$a_propriedades = $o_propriedade->select_agricultores_ativos();
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
        <table class="table datatable table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Estado</td>
                    <td>Municipio</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($a_propriedades) { ?>
                    <?php foreach ($a_propriedades as $value) { ?>
                        <tr>
                            <td><?php echo $value['id_propriedade_rural']; ?></td>
                            <td><?php echo $value['estado']; ?></td>
                            <td><?php echo $value['municipio']; ?></td>
                            <!--<td><a href="agricultor/<?php // echo $value['id_usuario']; ?>/cadastrar/producao" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a></td>-->
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