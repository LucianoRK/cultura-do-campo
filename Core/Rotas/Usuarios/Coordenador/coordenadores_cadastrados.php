<?php
$o_coordenador = new Coordenador();
$a_coordenadores = $o_coordenador->select_coordenadores();
?>


<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Coordenadores cadastrados
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">	
        <table class="table datatable table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>CPF</td>
                    <td>Email</td>
                </tr>
            </thead>
            <tbody>
                <?php if ($a_coordenadores) { ?>
                    <?php foreach ($a_coordenadores as $value) { ?>
                        <tr>
                            <td><?php echo $value['id_usuario']; ?></td>
                            <td><?php echo $value['nome']; ?></td>
                            <td><?php echo $value['cpf']; ?></td>
                            <td><?php echo $value['email']; ?></td>
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