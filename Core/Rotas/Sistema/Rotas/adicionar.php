
<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Nova rota
                </h3>
            </div>
        </div>
    </div>
    <form id="form_rotas" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div id="form_adicionar_rota" class="m-portlet__body">	

        </div>
        <br>    
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="m--align-right col-md-12" style="position: initial;">
                        <button id="cadastrar_rota" type="button" class="btn btn-success">Salvar rota</button>
                        <button type="reset" class="btn btn-secondary">Limpar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




<script>

    $(document).ready(function () {
        load_form();
        blockPage();
    });

    function load_form() {
        $("#form_adicionar_rota").load("sistema/rotas/form/adicionar", {}, function () {
            unblockPage();
        });
    }

</script>