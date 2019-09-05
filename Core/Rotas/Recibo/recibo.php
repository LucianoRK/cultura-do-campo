<?php
    if(isset($_GET['id_compra']) && !empty($_GET['id_compra'])){
        $id_compra = $_GET['id_compra'];
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Atenção</strong> Problema ao gerar recibo.
            </div>";
        die();
    }
    
    $o_compra = new Compras();
    $compra = $o_compra->select_compra_especificada($id_compra);
    
    /*$o_endereco = new Endereco();
    $o_endereco->select_endereco();*/
?>

<style>
    #logo_recibo{
        width: 50px;
        height: 50px;
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
                    Impressão de Recibo
                </h3>
            </div>
        </div>
    </div>
    <form id="form_fornecedor" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
        <div id="form_recibo" class="m-portlet__body">	

        </div>
    </form>
</div>



<script>
    function load_form() {
        $("#form_recibo").load("form/recibo", {}, function () {
            unblockPage();
        });
    }

    $(document).ready(function () {  
        blockPage();
        load_form();
        
        $("#imprimir_recibo").on("click", function () {

        });
    });

</script>