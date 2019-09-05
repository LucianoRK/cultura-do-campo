
<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Lista de Fornecedores
                </h3>
            </div>
        </div>
    </div>
    <form id="form_fornecedor" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div id="lista_fornecedores" class="m-portlet__body">	

        </div>
    </form>
</div>



<script>
    function load_form() {
        $("#lista_fornecedores").load("tabela/fornecedor", {}, function () {
            unblockPage();
        });
    }
    
    $(document).ready(function () {  
        blockPage();
        load_form();
    });
</script>