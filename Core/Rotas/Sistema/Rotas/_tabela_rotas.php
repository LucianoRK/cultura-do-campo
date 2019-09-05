<?php
$o_rota = new Rota();
$rotas = $o_rota->select_all_rotas();
foreach ($rotas as $key => $rota) {
    if ($rota['matriz'] == "base_admin.php") {
        $rota['matriz'] = "Administração";
    } else if ($rota['matriz'] == "base_interface.php") {
        $rota['matriz'] = "Interface";
    } else if ($rota['matriz'] == "base_login.php") {
        $rota['matriz'] = "Base login";
    } else {
        $rota['matriz'] = "Ajax/Load";
    }

    $rota['expressao'] = STRINGS::regex_to_url($rota['expressao']);


    $rotas[$key] = $rota;
}
?>

    <table class="table table-bordered table-hover table-bordered" id="rotas_table">
        <thead>
            <tr>
                <th width="5%" class="text-center ">ID</th>
                <th class="">URI</th>
                <th class="text-center">Tipo</th>
                <th class="">Conteúdo</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($rotas) { ?>
                <?php foreach ($rotas as $value) { ?>
                    <tr  href="sistema/rotas/<?php echo $value['id_rota']; ?>/detalhes/" class="pointer" id="<?php echo $value['id_rota']; ?>">
                        <td class="text-center" ><?php echo $value['id_rota']; ?></td>
                        <td class="text-truncate" width="20%"><?php echo $value['expressao']; ?></td>
                        <td class="text-center"><?php echo $value['matriz']; ?></td>
                        <td class=""><?php echo $value['conteudo']; ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>


<script>
    $(document).ready(function () {


        function showAlert() {
            new PNotify({
                text: 'Status alterado!',
                delay: 1500,
                type: 'success',
                addclass: "stack-bottomright",
                animate: {
                    animate: true,
                    in_class: 'bounceInUp',
                    out_class: 'bounceOutRight'
                }
            });
        }


        $('#rotas_table').DataTable({
            "order": [],
            "paging": true,
            pageLength: 30
        });

        $("#rotas_table tbody").on("click", "tr", function () {
            window.location = $(this).attr("href");
        });


        if ($('.switcher').length > 0) {
            var elems = Array.prototype.slice.call($('.switcher'));
            elems.forEach(function (html) {
                var switchery = new Switchery(html, {
                    color: QuantumPro.APP_COLORS.success,
                    secondaryColor: QuantumPro.APP_COLORS.grey200,
                    className: "switchery switchery-small"

                });
            });
        }

        $('.switcher').on('change', function () {
            var id = $(this).closest('tr').attr('id');
            $.post('alterar-status-rota', {id_rota: id}, function (response) {
                showAlert();
            });
        });

        $(".vincular_permissao").off("click");
        $(".vincular_permissao").on("click", function () {
            $(".nav-tabs li:nth-child(1) a").removeClass('active');
            $(".nav-tabs li:nth-child(1) a").removeClass('show');
            $(".nav-tabs li:nth-child(2) a").addClass('active');
            $(".nav-tabs li:nth-child(2) a").addClass('show');
            $(".tab-content #rotas").removeClass('active');
            $(".tab-content #permissoes").addClass('active');
        });



    });
</script>