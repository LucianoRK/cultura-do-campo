<?php
$o_filiado       = new Filiado();
$o_matriz_fiscal = new MatrizFiscal();

$cnaes      = $o_matriz_fiscal->select_cnaes();
$tributacao = $o_matriz_fiscal->select_regimes_tributacao();
$matriz     = $o_matriz_fiscal->select_matriz_fiscal_filiado($_SESSION['id_filiado']);

$filiado = $o_filiado->select_informacoes_filiado_especificado($_SESSION['id_filiado']);
?>


<div class="m-portlet m-portlet--full-height ">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Matriz fiscal
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form id='form_fiscal' class="m-form">
        <div class="m-portlet__body">


            <div class="form-group m-form__group row">
                <div class="col-md-6">
                    <label>Nome fantasia</label>
                    <input type="text" class="form-control m-input" name="nome_fantasia" value='<?php echo $filiado['nome_fantasia']; ?>'>
                </div>
                <div class="col-md-6">
                    <label>Razão social</label>
                    <input type="text" class="form-control m-input" name="razao_social" value='<?php echo $filiado['razao_social']; ?>'>
                </div>

            </div>


            <div class="form-group m-form__group row">
                <div class="col-md-6">
                    <label>CNPJ</label>
                    <input type="text" class="form-control m-input cnpj" name="cnpj" value='<?php echo $filiado['cnpj']; ?>'>
                </div>
                <div class="col-md-6">
                    <label>Código de regime tributário</label>
                    <select class="form-control selectpicker" name="crt">
                        <option value='0'>[Selecione o código de regime tributário]</option>
                        <option <?php echo $matriz['crt'] == '1' ? 'selected' : ''; ?> value='1'>1 - Simples nacional</option>
                        <option <?php echo $matriz['crt'] == '2' ? 'selected' : ''; ?> value='2'>2 - Simples nacional - Excesso de sublimite de receita bruta</option>
                        <option <?php echo $matriz['crt'] == '3' ? 'selected' : ''; ?> value='3'>3 - Regime normal</option>
                    </select>
                </div>

            </div>

            <div class="form-group m-form__group row">
                <div class="col-md-12">
                    <label>Regime especial de tributação - serviços</label>
                    <select class="form-control selectpicker" name="id_regime_tributacao">
                        <?php if (is_array($tributacao)) { ?>
                            <option value='0'>[Selecione o regime de tributação]</option>

                            <?php foreach ($tributacao as $value) { ?>
                                <option <?php echo $matriz['fk_regime_tributacao'] == $value['id_regime'] ? 'selected' : ''; ?> value='<?php echo $value['id_regime']; ?>'><?php echo $value['id_regime']; ?> - <?php echo $value['descricao']; ?></option>

                            <?php } ?>
                        <?php } else { ?>

                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-md-12">
                    <label>CNAE - Código nacional de atividade econômica</label>
                    <select name="cnae" data-live-search='true' class='form-control selectpicker'>
                        <option value='0'>[Selecione o CNAE da sua empresa]</option>
                        <?php if (is_array($cnaes)) { ?>
                            <?php foreach ($cnaes as $value) { ?>
                                <option <?php echo $matriz['fk_cnae'] == $value['id_cnae'] ? 'selected' : ''; ?> value='<?php echo $value['id_cnae']; ?>'><?php echo $value['codigo_cnae']; ?> - <?php echo $value['desc_cnae']; ?></option>
                            <?php } ?>
                        <?php } else { ?>

                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="form-group m-form__group row">
                <div class="col-md-6">
                    <label>Inscrição Municipal</label>
                    <input type="text" class="form-control m-input" name="inscricao_municipal" value="<?php echo $matriz['inscricao_municipal']; ?>">
                </div>
                <div class="col-md-6">
                    <label>Inscrição Estadual</label>
                    <input type="text" class="form-control m-input" name="inscricao_estadual" value="<?php echo $matriz['inscricao_estadual']; ?>">
                </div>

            </div>


        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                <button id='update_matriz' type="reset" class="btn btn-success">Atualizar dados</button>
            </div>
        </div>
    </form>

</div>

<script>
    $(document).ready(function () {
        $(".selectpicker").selectpicker();
        $(".cnpj").mask("00.000.000/0000-00");

        $("#update_matriz").off("click");
        $("#update_matriz").on("click", function () {
            var formData = $("#form_fiscal").serializeArray();
            $.ajax({
                type: "post",
                url: "usuario/update/fiscal",
                data: formData,
                success: function (response) {
                    lerResposta(response, carregar_matriz_fiscal);
                }
            });

        });

    });
</script>