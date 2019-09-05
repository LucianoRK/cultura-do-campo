<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Cadastro de coordernador
                </h3>
            </div>
        </div>
    </div>
    <form id="form_coordenador" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div id="cadastro_coordenador" class="m-portlet__body">	

        </div>
        <br>    
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12  m--align-right">
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
    });

    function load_form() {
        $("#cadastro_coordenador").load("usuario/form/coordenador", {}, function () {
            unblockPage();
        });
    }

    $("#cadastrar").on("click", function () {
        executar_cadastro();
    });

    function executar_cadastro() {
        hideNotify();
        blockPage();
        var formData = $("#form_coordenador").serialize();
        console.log(formData);
        $.ajax({
            type: "post",
            url: "usuario/insert_coordenador",
            data: formData,
            success: function (json) {
                if (is_json(json)) {
                    var response = JSON.parse(json);
                    if (response.result) {
                        load_form();
                        notify(response.message, 'alert-success');
                    } else {
                        unblockPage();
                        notify(response.message, 'alert-danger');
                    }
                } else {
                    unblockPage();
                    notify("Resposta inesperada do servidor", 'alert-danger');
                }

            },
            error: function (error) {
                notify("Erro: Entre em contato com o suporte", 'alert-danger');
            }
        });
    }

</script>