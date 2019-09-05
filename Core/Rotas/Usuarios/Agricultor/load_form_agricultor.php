<?php
$o_certificacao = new Certificacao();
$o_estado_civil = new EstadoCivil();
$o_comunhao = new ComunhaoBens();

$id_tipo_usuario = SESSION::get_id_tipo_usuario();
$a_certificacoes = $o_certificacao->select_todas_certificacoes();
$a_estado_civil = $o_estado_civil->select_todos_estados_civis();
$a_comunhao_bens = $o_comunhao->select_todas_comunhao_bens();
?>

<form id="form_agricultor" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">

    <div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        1. Dados básicos do agricultor
                    </h3>
                </div>
            </div>
        </div>
        <div  class="m-portlet__body">	



            <?php include 'Core/Rotas/Usuarios/include_form_usuario.php'; ?>
            <?php include 'Core/Rotas/Usuarios/include_form_telefone.php'; ?>

            <div class="col-md-12">
                <div class="form-group m-form__group row">
                    <div class="col-md-6">
                        <label for="id_estado_civil">Estado civil</label>
                        <select id="estado_civil" data-style="btn-outline-info"  name="id_estado_civil" class="form-control">
                            <?php if ($a_estado_civil) { ?>
                                <?php foreach ($a_estado_civil as $value) { ?>
                                    <option value="<?php echo $value['id_estado_civil']; ?>"><?php echo $value['estado_civil']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row" id="informacoes_conjuge" style="display: none">
                    <div class="col-md-6">
                        <label for="nome_conjuge">Nome do cônjuge</label>
                        <input name="nome_conjuge" type="text" class="form-control m-input" placeholder="Nome completo do cônjuge">
                    </div>
                    <div class="col-md-6">
                        <label for="comunhao_bens">Comunhão de bens</label>
                        <select data-style="btn-outline-info"  name="id_comunhao_bens" class="form-control selectpicker" data-live-search="true">
                            <?php if ($a_comunhao_bens) { ?>
                                <?php foreach ($a_comunhao_bens as $value) { ?>
                                    <option value="<?php echo $value['id_comunhao']; ?>"><?php echo $value['comunhao_bens']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12">



                <div class="form-group m-form__group row">
                    <div class="col-md-6">
                        <label for="rg">RG do agricultor</label>
                        <input name="rg" type="text" class="form-control m-input" placeholder="Registro geral">
                        <span class="m-form__help">Somente números</span>
                    </div>
                    <div class="col-md-6">

                        <label for="caepf">CAEPF</label>
                        <input name="caepf" type="text" class="form-control m-input caepf" placeholder="Cadastro de Atividade Econômica da Pessoa Física">
                        <span class="m-form__help">Somente números</span>

                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-md-6">
                        <label for="integrantes_upf">Número de integrantes da UPF</label>
                        <input pattern="\d+" name="integrantes_upf" type="text" class="form-control m-input" placeholder="Informe a quantidade">
                    </div>

                </div>
            </div>

        </div>
        <br>
    </div>

    <div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        2. Dependentes
                    </h3>
                </div>
            </div>
        </div>
        <div  class="m-portlet__body">
            <div id="dependentes_repeater">
                <div data-repeater-list="dependentes" >
                    <div class="form-group m-form__group" >

                        <div data-repeater-create class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--wide">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Adicionar dependentes</span>
                            </span>
                        </div>
                        <span style='margin-left: 16px;'>  Clique para adicionar os dependentes do agricultor</span>
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
                                            Novo dependente
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
                                    <div class="col-md-8">
                                        <label for="nome_dependente">Nome do dependente</label>
                                        <input name="nome_dependente" type="text" class="form-control m-input" placeholder="Nome completo do dependente">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="data_nascimento_dependente">Data de nascimento</label>
                                        <input  name="data_nascimento_dependente" type="text" class="form-control m-input data" placeholder="dd/mm/yyyy">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        3. Cadastro de propriedade
                    </h3>
                </div>
            </div>
        </div>
        <div  class="m-portlet__body">
            <div class="col-md-12">
                <div class="form-group m-form__group row">
                    <div class="col-md-6">
                        <label for="id_certificacao">Certificação orgânica</label>
                        <select data-style="btn-outline-info"  name="id_certificacao" class="form-control selectpicker" data-live-search="true">
                            <?php if ($a_certificacoes) { ?>
                                <?php foreach ($a_certificacoes as $value) { ?>
                                    <option value="<?php echo $value['id_certificacao']; ?>"><?php echo $value['descricao']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php require 'Core/Rotas/Endereco/include_maps_lat_lng.php'; ?>
        </div>
        <br>    
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="m--align-right col-md-12" style="position: initial;">
                        <button id="cadastrar" type="button" class="btn btn-success">Salvar usuário</button>
                        <button type="reset" class="btn btn-secondary">Limpar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</form>


<script>

    $(document).ready(function () {
        $("#cadastrar").on("click", function () {
            executar_cadastro();
        });
        $(".caepf").mask("000.000.000/000-00");
        $(".data").mask("99/99/9999");


        $("#estado_civil").selectpicker();
        $("#estado_civil").off("change");
        $("#estado_civil").on("change", function () {
            var estadoCivil = $(this).val();
            if (estadoCivil == 2) {
                $("#informacoes_conjuge").slideDown();
            } else {
                $("#informacoes_conjuge").slideUp();
            }
            $("#estado_civil").selectpicker('destroy');
            $("#estado_civil").selectpicker();

        });


        $('#dependentes_repeater').repeater({
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

    });

    function executar_cadastro() {
        hideNotify();
        blockPage();
        var formData = $("#form_agricultor").serialize();
        $.ajax({
            type: "post",
            url: "usuario/insert/agricultor",
            data: formData,
            success: function (response) {
                lerResposta(response, load_form);
            }
        });
    }

</script>