<?php
$o_permissao = new Permissao();
$o_rota = new Rota();
$o_permissao->set_id_permissao($_GET['id_permissao']);
$permissao = $o_permissao->select_permissao();
$arr_tipos = $o_permissao->select_usuarios_tipo();

$tipos_usuario = $o_permissao->select_tipos_usuario_permissao();
$tipos_usuario = explode(",", $tipos_usuario['ids']);

$arr_rotas_permissao = $o_permissao->select_rotas_permissao();
$arr_rotas_permissao = explode(",", $arr_rotas_permissao['ids']);

$arr_rotas = $o_rota->select_all_rotas();
?>

<div class="" > 
    <form id="form_editar_permissao" class="m-form m-form--fit m-form--label-align-right animated fadeIn">

        <div class="m-subheader ">
            <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-progress">

                    </div>
                    <div class="m-portlet__head-wrapper">
                        <div class="m-portlet__head-caption">

                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    <span class="flaticon-add m--margin-right-20"></span> 
                                    <span class="text-primary" style="font-weight: lighter;">Edição de permissão (#<?php echo $_GET['id_permissao']; ?>)</span>
                                </h3>

                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <div class="btn-group">
                                <div class="m-portlet__head-tools">
                                    <div class="btn-group">
                                        <button id="alterar_permissao" type="button" class="btn btn-outline-info m-btn m-btn--icon m-btn--wide m-btn--md">
                                            <span>
                                                <i class="fa fa-check"></i>
                                                <span>Alterar permissão</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin: Form Body -->
                    <input name="id_permissao" type="hidden" value="<?php echo $_GET['id_permissao']; ?>">
                    <div  class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label class="">Rotas:</label>
                                <select data-live-search="true" name="rotas[]" class="form-control m-input selectpicker" multiple>
                                    <?php if ($arr_rotas) { ?>

                                        <?php foreach ($arr_rotas as $value) { ?>
                                            <?php if (in_array($value['id_rota'], $arr_rotas_permissao)) { ?>
                                                <option title="<?php echo $value['id_rota']; ?>" selected value="<?php echo $value['id_rota']; ?>">#<?php echo $value['id_rota']; ?> - <?php echo STRINGS::readable_regex($value['expressao']); ?></option>

                                            <?php } else { ?>
                                                <option title="<?php echo $value['id_rota']; ?>" value="<?php echo $value['id_rota']; ?>">#<?php echo $value['id_rota']; ?> - <?php echo STRINGS::readable_regex($value['expressao']); ?></option>

                                            <?php } ?>

                                        <?php } ?>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-4">
                                <label>Descrição</label>
                                <input value="<?php echo $permissao['descricao']; ?>" type="text" name="descricao" class="form-control m-input" placeholder="Permissão">
                            </div>
                            <div class="col-lg-4">
                                <label class="">Tipo de usuário:</label>
                                <select name="tipo_usuario[]" class="form-control m-input selectpicker" multiple>
                                    <?php if ($arr_tipos) { ?>
                                        <?php foreach ($arr_tipos as $value) { ?>
                                            <option <?php echo in_array($value['id_tipo_usuario'], $tipos_usuario) ? 'selected' : ''; ?> value="<?php echo $value['id_tipo_usuario']; ?>"><?php echo $value['nome']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="m-form__help">Selecione ao menos um tipo</span>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Status:</label>
                                <select name="status" class="form-control m-input selectpicker">
                                    <option <?php echo $permissao['ativo'] ? 'selected' : ''; ?> value="1">Ativado</option>
                                    <option <?php echo!$permissao['ativo'] ? 'selected' : ''; ?> value="0">Desativado</option>
                                </select>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function () {
        $("#alterar_permissao").on("click", function () {
            var formData = $("#form_editar_permissao").serializeArray();
            $.ajax({
                type: "post",
                url: "sistema/permissao/editar",
                data: formData,
                success: function (response) {
                    alert(response);
                },
                error: function (error) {
                    swal("Erro: Entre em contato com o suporte (COD: L001)");
                }
            });
        });
    });
</script>