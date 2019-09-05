

<div class="m-portlet m-portlet--blue m-portlet--head-solid-bg m-portlet--head-sm" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Rotas cadastradas
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">	
        <div  id="tabela_rotas">

        </div>
    </div>

</div>



<script>
    $(document).ready(function () {
        load_rotas();
        function load_rotas() {
            $("#tabela_rotas").load("sistema/rotas/_tabela_rotas");
        }
    });
</script>