<?php
$o_produto = new Produto();
$o_medida = new Medida();

$produtos = $o_produto->select_produtos();
$unidades = $o_medida->select_unidades_medida();
?>
<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-12">
            <label for="id_produto">Produto</label>
            <select name='id_produto' data-live-search="true" class="form-control selectpicker">
                <option selected>[Selecione um produto]</option>
                <?php if ($produtos) { ?>
                    <?php foreach ($produtos as $value) { ?>
                        <option value='<?php echo $value['id_produto']; ?>'><?php echo $value['nome']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <span class="m-form__help">Selecione o produto</span>
        </div>
    </div>	 
    <div class="form-group m-form__group row">
        <div class="col-md-4">
            <label for="usuario">Unidade de medida</label>
            <div class="m-input-icon m-input-icon--right">
                <select id="unidade_medida" name='id_unidade' data-live-search="true" class="form-control selectpicker">
                    <option selected>[Selecione a unidade]</option>
                    <?php if ($produtos) { ?>
                        <?php foreach ($unidades as $value) { ?>
                            <option value='<?php echo $value['id_unidade']; ?>'><?php echo $value['descricao']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <!--<span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-user"></i></span></span>-->
            </div>
            <span class="m-form__help">Unidade de medida</span>
        </div>
        <div class="col-md-8">
            <label for="quantidade">Quantidade</label>
            <div class="m-input-icon m-input-icon--right">
                <input name="quantidade" type="text" class="form-control m-input" placeholder="Quantidade do produto escolhido">
                <!--<span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>-->
            </div>
            <span class="m-form__help text-info">Relacionado à unidade de medida escolhida</span>
        </div>

    </div>

    <div class="form-group m-form__group row">

        <div class="col-md-12">
            <label for="periodo_final">Período de safra</label>
            <div class="input-daterange input-group">
                <input readonly="" type="text" class="form-control m-input text-right" name="periodo_inicial" placeholder="Data inicial">
                <div class="input-group-append">
                    <span class="input-group-text">até</span>
                </div>
                <input readonly="" type="text" class="form-control m-input text-left" name="periodo_final" placeholder="Data final">
            </div>
            <!--<span class="m-form__help">Escolha uma data inicial e uma data final</span>-->
        </div>


    </div>
</div>


<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();

        $('input[name=periodo_inicial]').datepicker({
            format: "dd/mm/yyyy",
            orientation: "bottom right"
        });
        $('input[name=periodo_final]').datepicker({
            format: "dd/mm/yyyy",
            orientation: "bottom left"
        });
    });
</script>
