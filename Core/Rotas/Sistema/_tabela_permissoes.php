<?php
$o_permissao = new Permissao();
$arr_permissoes = $o_permissao->select_all_permissoes();
?>


<table class="table table-striped- table-bordered table-hover" id="permissoes_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo de usuários</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($arr_permissoes) { ?>
            <?php foreach ($arr_permissoes as $value) { ?>
                <tr class="pointer permissao" href="sistema/permissoes/<?php echo $value['id_permissao']; ?>/editar">
                    <td class="text-center"><?php echo $value['id_permissao']; ?></td>
                    <td><?php echo $value['descricao']; ?></td>
                    <td><?php echo $value['usuarios']; ?></td>
                </tr>
            <?php } ?>

        <?php } ?>

    </tbody>
</table>


<script>
    $(document).ready(function () {
        $("#permissoes_table").DataTable({"order": [], paging: true, pageLength: 30});
        $("#permissoes_table").on("click", ".permissao", function () {
            var href = $(this).attr("href");
            window.location = href;
        });
    });
</script>