<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Estoque
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" id="listar_estoque">
        
    </div>
    
</div>



<script>
    function load_list() {
        $("#listar_estoque").load("estoque/listar", {}, function () {});
    }
    $(document).ready(function () {
        load_list();
    });
</script>