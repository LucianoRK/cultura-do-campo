<?php
$o_permissao = new Permissao();
$arr_tipos = $o_permissao->select_usuarios_tipo();
?>
<style>
    .m-wrapper{
        padding: 8px!important;
    }
    .m-portlet{
        box-shadow: none!important;
    }
</style>

<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Permissões de acesso
                </h3>
            </div>
        </div>
    </div>
    <form id="form_permissao" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div class="m-portlet__body">	
            <div class="form-group m-form__group row">
                <div class="col-md-12">
                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control m-input" placeholder="Permissão">
                </div>

            </div>
            <div class="form-group m-form__group row">
                <div class="col-md-12">
                    <label class="">Tipo de usuário:</label>
                    <select name="tipo_usuario[]" class="form-control m-input selectpicker" multiple>
                        <?php if ($arr_tipos) { ?>
                            <?php foreach ($arr_tipos as $value) { ?>
                                <option value="<?php echo $value['id_tipo_usuario']; ?>"><?php echo $value['nome']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <span class="m-form__help">Selecione ao menos um tipo</span>
                </div>
            </div>
        </div>
        <br>    
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="m--align-right col-md-12" style="position: initial;">
                        <button id="cadastrar_permissao" type="button" class="btn btn-success">Salvar permissão</button>
                        <button type="reset" class="btn btn-secondary">Limpar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Permissões disponíveis
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">	
        <div  id="tabela_permissoes">

        </div>
    </div>

</div>



<script>
    $(document).ready(function () {
        carregar_permissoes();
        $("#cadastrar_permissao").on("click", function () {
            var formData = $("#form_permissao").serialize();
            $.ajax({
                type: "post",
                url: "insert-permissao",
                data: formData,
                success: function (response) {
                    lerResposta(response, carregar_permissoes);
                }
            });
        });
    });


    function carregar_permissoes() {
        $("#tabela_permissoes").load("tabela-permissoes");
        $("#form_permissao").trigger('reset');
    }
</script>


