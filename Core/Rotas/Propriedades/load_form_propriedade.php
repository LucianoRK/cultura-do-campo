<?php
$o_certificacao = new Certificacao();
$a_certificacoes = $o_certificacao->select_todas_certificacoes();

$id_tipo_usuario = SESSION::get_id_tipo_usuario();
?>

<?php if ($id_tipo_usuario <> 5 && $id_tipo_usuario <> 3) { ?>
    <div class="col-md-12">
        <div class="form-group m-form__group row">

            <div class="col-md-6">
                <label for="rg">Agricultor</label>

                <?php
                $o_agricultor = new Agricultor();
                $a_agricultores = $o_agricultor->select_agricultores_ativos();
                ?>
                <select data-live-search="true" data-style="btn-outline-info" name="id_agricultor" class="form-control selectpicker">
                    <option value="">[Selecione o agricultor responsável]</option>
                    <?php if ($a_agricultores) { ?>
                        <?php foreach ($a_agricultores as $value) { ?>
                            <option  value="<?php echo $value['id_agricultor']; ?>"><?php echo $value['nome']; ?></option>
                        <?php } ?>
                    <?php } ?>

                </select>
            </div>

            <div class="col-md-6">
                <label for="rg">Técnico responsável</label>

                <?php
                $o_tecnico = new Tecnico();
                $a_tecnicos = $o_tecnico->selectTecnicosAtivos();
                ?>
                <select data-live-search="true" data-style="btn-outline-info" name="id_tecnico" class="form-control selectpicker">
                    <option value="">Nenhum técnico ficará responsável por este propriedade</option>
                    <?php if ($a_tecnicos) { ?>
                        <?php foreach ($a_tecnicos as $value) { ?>
                            <option  value="<?php echo $value['id_tecnico']; ?>"><?php echo $value['nome']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

<?php } ?>

<div class="col-md-12">

    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label for="id_certificacao">Certificação orgânica</label>
            <select name="id_certificacao" class="form-control selectpicker" data-live-search="true">
                <?php if ($a_certificacoes) { ?>

                    <?php foreach ($a_certificacoes as $value) { ?>
                        <option value="<?php echo $value['id_certificacao']; ?>"><?php echo $value['descricao']; ?></option>
                    <?php } ?>

                <?php } ?>
            </select>
        </div>
    </div>
</div>


<?php include 'Core/Rotas/Endereco/include_maps_lat_lng.php'; ?>


<script>

    $(document).ready(function () {
        $(".caepf").mask("000.000.000/000-00");
    });

</script>