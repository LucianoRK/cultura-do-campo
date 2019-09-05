<style>
    #valor_total_compra{
        font-size: 15px;
        font-weight: bold;
        color: green;
    }
</style>

<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Nova Compra
                </h3>
            </div>
        </div>
    </div>
    <form id="form_tecnico" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div id="cadastro_compra" class="m-portlet__body">	

        </div>
        <br>    
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="m--align-right col-md-12" style="position: initial;">
                        <button id="salvar_compra" type="button" class="btn btn-success">Salvar </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<script>
    function load_form() {
        $("#cadastro_compra").load("compra/nova/form", {}, function () {
            unblockPage();
        });
    }
    
    function salvar_compra(){
        hideNotify();
        blockPage();
        dados_extra['n_parcelas'] = $("#parcelas").val();
        dados_extra['data_pagamento'] = $("#data_pagamento").val();
        dados_extra['obs'] = $("#obs_pagamento").val();
        dados_extra['data_busca'] = $("#data_busca").val();
        
        $.ajax({
            type: "post",
            url: "compra/nova/insert",
            data: {dados: array_produtos, fk_produtor: dados_extra['fk_produtor'], valor_total: dados_extra['valor_total'], buscar_prod: dados_extra['buscar_prod'], data_pagamento: dados_extra['data_pagamento'], obs: dados_extra['obs'], parcela: dados_extra['n_parcelas'], data_busca: dados_extra['data_busca']},
            success: function (response) {
                var res;
                res = lerResposta(response, load_form);
                
                if(res){
                    array_produtos.length = 0;    
                    dados_extra.length = 0;
                }
            }
        });
    }

    $(document).ready(function () {  
        blockPage();
        load_form();
        array_produtos = [];
        dados_extra = [];
        
        $("#salvar_compra").on("click", function () {
            salvar_compra();
        });
    });

</script>