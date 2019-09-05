
<div class="col-md-12">
    <div class="form-group m-form__group">

        <label for="rg">Filiado</label>

        <?php
        $o_filiado = new Filiado();
        $a_filiados = $o_filiado->select_todos_filiados_ativos();
        ?>
        <select data-live-search="true" data-style="btn-outline-info" name="id_filiado" class="form-control selectpicker">
            <option value="">[Selecione o filiado]</option>
            <?php if ($a_filiados) { ?>
                <?php foreach ($a_filiados as $value) { ?>
                    <option  value="<?php echo $value['id_filiado']; ?>"><?php echo $value['nome_fantasia']; ?></option>
                <?php } ?>
            <?php } ?>

        </select>
    </div>
    <div class="form-group m-form__group">
        <div class="input-group m-input-group m-input-groupsolid input-group-lg">
            <div class="input-group-prepend"><span class="input-group-text">
                    Informe o CPF do agricultor
                </span>
            </div>
            <input id="localizar_agricultor" type="text" class="form-control m-input" placeholder="Somente números" maxlength="11">
        </div>
    </div>
    <div id='retorno_agricultor' style='display: none;'>

    </div>
</div>

<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-12">
            <label for="numero_matricula">Número da matrícula</label>
            <div class="input-group m-input-group">
                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                <input name="numero_matricula" type="text" class="form-control m-input" placeholder="Somente números" maxlength="25">
            </div>
        </div>
    </div>
    <div id="cargos_repeater">
        <div data-repeater-list="cargos" >
            <div class="form-group m-form__group" >

                <div data-repeater-create class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--wide">
                    <span>
                        <i class="la la-plus"></i>
                        <span>Adicionar cargo</span>
                    </span>
                </div>
                <span style='margin-left: 16px;'>  Este agricultor possui ou possuiu um cargo neste associação/cooperativa?</span>
            </div>
            <div data-repeater-item class="form-group m-form__group" style='padding-bottom: 10px;'>

                <div class="m-portlet m-portlet--grey m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_2">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="la la-plus"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Adicionar cargo
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <a data-repeater-delete="" m-portlet-tool="toggle" class="pointer m-portlet__nav-link m-portlet__nav-link--icon" aria-describedby="tooltip_u8x7mgl56i"><i class="la la-close"></i></a>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body form-group m-form__group">
                        <div class="row" >
                            <div class="col-md-4">
                                <label for="cargo">Cargo</label>
                                <input name="cargo" type="text" class="form-control m-input" placeholder="Título do cargo">
                            </div>
                            <div class="col-md-4">
                                <label for="data_inicio">Data de início do cargo</label>
                                <input  name="data_inicio" type="text" class="form-control m-input data" placeholder="dd/mm/yyyy">
                            </div>
                            <div class="col-md-4">
                                <label for="data_fim">Data de término do cargo</label>
                                <input name="data_fim" type="text" class="form-control m-input data" placeholder="dd/mm/yyyy">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="obs" class="form-control" placeholder="Observações/Advertências" style="resize: none" rows="1"></textarea>
                                <span class="m-form__help">Informações relevantes relacionadas ao exercício do cargo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function () {
        $(".data").mask("99/99/9999");
        $(".selectpicker").selectpicker();

        $('#cargos_repeater').repeater({
            initEmpty: true,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
                initMask();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: false
        });


        $("#localizar_agricultor").on("input", function () {
            var input = $(this);
            var cpf = input.val();

            $("#retorno_agricultor").slideUp();
            if (cpf.length == 11) {
                blockElement(input.parent());
                $("#retorno_agricultor").load("agricultor/localizar/cpf", {cpf: cpf}, function () {
                    $("#retorno_agricultor").slideDown();
                    unblockElement(input.parent());
                });
            }
        });
    });
</script>