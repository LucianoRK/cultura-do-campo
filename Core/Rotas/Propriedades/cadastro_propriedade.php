<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Cadastro de propriedade rural
                </h3>
            </div>
        </div>
    </div>
    <form id="form_propriedade" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div id="cadastro_propriedade" class="m-portlet__body">	

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
    </form>
</div>



<script>

    $(document).ready(function () {
        blockPage();
        load_form();
        $("#cadastrar").on("click", function () {
            executar_cadastro();
        });
    });

    function load_form() {
        $("#cadastro_propriedade").load("propriedade/nova/form", {}, unblockPage());
    }

    function executar_cadastro() {
        hideNotify();
        blockPage();
        var formData = $("#form_propriedade").serialize();
        $.ajax({
            type: "post",
            url: "propriedade/insert",
            data: formData,
            success: function (response) {
                lerResposta(response, load_form);
            }
        });
    }


</script>