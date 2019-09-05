<?php
$o_estado = new Estado();
$estados = $o_estado->select_todos_estados();
?>
<div class="col-md-12" id="include_estado_municipio">
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label for="estado">Estado</label>
            <select id="uf" name="estado" class="form-control m-input selectpicker" data-live-search="true">
                <option selected value="">Escolha um estado</option>

                <?php if ($estados) { ?>

                    <?php foreach ($estados as $value) { ?>
                        <option value="<?php echo $value['uf']; ?>"><?php echo $value['nome']; ?></option>
                    <?php } ?>

                <?php } ?>
            </select>
            <span class="m-form__help">Escolha o estado de atuação</span>
        </div>
        <div id="select_municipios" class="col-lg-6">
            <label for="município">Município</label>
            <input class="form-control" disabled value="Escolha um estado">
            <span class="m-form__help">Escolha o município de atuação</span>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".selectpicker").selectpicker();
        $("#uf").on("change", function () {
            var uf = $(this).val();
            selectUf(uf);
        });
    });


    function selectUf(uf) {
        blockPage();
        $("#select_municipios").load("load/select/municipios", {uf: uf}, function () {
            unblockPage();
        });
        if (typeof geocoding === "function") {
            var siglaEstado = $("#uf").val();
            geocoding("Brasil, " + siglaEstado, 6);
        }
    }
</script>