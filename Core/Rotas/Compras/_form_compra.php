<?php
        $o_agricultor = new Agricultor();
        $fk_filiado = SESSION::get_id_filiado();
        $produtores = $o_agricultor->select_agricultores_ativos($fk_filiado);
        
        $categoriasProd = new CategoriaProdutos();
        $categorias = $categoriasProd->select_todas_categorias();
?>
                       
<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label for="example-date-input" class=" col-form-label"> Fornecedor </label>
            <select data-live-search="true" data-style="btn-outline-info" name="id_agricultor" id="id_agricultor" class="form-control selectpicker">
                <?php if ($produtores) { ?>
                    <option selected="" disabled=""> Agricultores </option>
                    <?php foreach ($produtores as $value) { ?>
                        <option  value="<?php echo $value['id_agricultor']; ?>"> <?php echo $value['nome'] . ' | ' . $value['cpf']; ?> </option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>  
        <div class="col-lg-6">
            <label for="example-date-input" class=" col-form-label"> Buscar Produto </label>
            <select data-style="btn-outline-info" name="buscar_prod" id="buscar_prod" class="form-control selectpicker">
                <option selected="" value="0" disabled=""> Transporte </option>
                <option  value="1"> Sim </option>
                <option  value="2"> Não </option>
            </select>
        </div>
        
        <div class="col-lg-3 form-group">
            <label for="example-date-input" class="col-form-label">Data Pagamento</label>
            <input class="form-control" type="date" value="" name="data_pagamento" id="data_pagamento">
        </div>
        
         <div class="col-lg-3">
                <label for="exampleSelect1" class=" col-form-label">Parcelas</label>
                <select class="form-control m-input" name="parcelas" id="parcelas">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                </select>
         </div>
        
        <div class="col-lg-6 div_buscar d-none">
            <label for="example-date-input" class=" col-form-label">Data de Busca</label>
            <input class="form-control" type="date" value="" disabled="" name="data_busca" id="data_busca">
        </div>
        
        <div class="col-lg-12">
            <label for="exampleTextarea" class=" col-form-label"> Obs. pagamento </label>
            <textarea class="form-control" id="obs_pagamento" name="obs_pagamento" rows="3"></textarea>
        </div>
    </div>	 
</div>

<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
            </span>
            <apan class="m-portlet__head-text">
                Lista de Produtos
            </h3>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-2">
            <select name="categoria" id="categoria" class="form-control m-input selectpicker text-center">
                <?php if ($categorias) { ?>
                    <option selected="" name="categoria" disabled=""> Categorias </option>
                    <?php foreach ($categorias as $value) { ?>
                        <option value="<?php echo $value['id_categoria']; ?>"> <?php echo $value['nome']; ?> </option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-2" id="produtos">
            
        </div>
        
        <div class="col-md-2">
            <select name="medida" id="medida" class="form-control m-input selectpicker text-center">
                <option selected="true" disabled="true" value="">Medida </option>
                <option value="1"> Unidade </option>
                <option value="2"> KG </option>
            </select>
        </div>
        
        <div class="col-md-2">
            <input name="qtd" disabled="true" id="qtd" type="text" class="form-control m-input text-center" placeholder="Quantidade">
        </div>
        
        <div class="col-md-2">
            <input name="valor" id="valor" type="text" class="form-control m-input text-center valor_pro" placeholder="Valor p/ unid. ou KG">
        </div>
        
        <button type="button" id="adicionar_produto" class="btn btn-primary"> <i class="la la-plus"></i> Adicionar </button>
    </div>
    <div id="compra_tabela">


    </div>
</div>


<script>
    function load_tabela() {
        $("#compra_tabela").load("compra/tabela", {}, function () {
            unblockPage();
        });
        
        $("#adicionar_produto").off("click");
        $("#adicionar_produto").on("click", function () {
            
            let categoria = $("#categoria").val();
            let produto = $("#produto").val();
            let qtd = $("#qtd").val();
            let medida = $("#medida").val();
            let valor = $("#valor").val();
            
            if(categoria && produto && qtd && medida && valor){
                array_produtos.push({categoria: categoria, produto: produto, medida: medida, qtd: qtd, valor: valor});

                $("#compra_tabela").load("compra/tabela", {array_produtos: array_produtos}, function () {
                    unblockPage();
                });
            }else{
                swal("Por favor, preecha todos os campo");
            }
        });
    }
    
    function buscar_produtos(){
        $("#produtos").load("load/select/produtos", {}, function () {
            unblockPage();
        });
        
        $("#categoria").off("change");
        $("#categoria").on("change", function () {
            let categoria = $("#categoria").val();
            
            $("#produtos").load("load/select/produtos", {categoria: categoria}, function () {
                unblockPage();
            });
        });
    }
    
    function select_produtor(){
        $("#id_agricultor").off("change");
        $("#id_agricultor").on("change", function () {
            dados_extra['fk_produtor'] = $(this).val();
        });
    }
    
    function select_medida(){
        $("#medida").off("change");
        $("#medida").on("change", function () {
            $("#qtd").attr("disabled", false);
            $("#qtd").val("");
            var medida = $(this).val();
            
            if(medida == "1"){
               $('#qtd').mask("#", {reverse: true});
            }else{
                $('#qtd').mask("000.000.000", {reverse: true});
            }
        });
    }
    
    function select_buscar_produto(){
        $("#buscar_prod").on("change", function (){
            transporte = $("#buscar_prod").val();
            dados_extra['buscar_prod'] = transporte;
            
            if(transporte == 1){
                $(".div_buscar").removeClass("d-none");
                $("#data_busca").attr("disabled", false);
            }else{
                $(".div_buscar").addClass("d-none");
                $("#data_busca").attr("disabled", true);
            }
        });
    }
    
    
    $(document).ready(function () { 
        buscar_produtos();
        load_tabela();
        select_produtor();
        select_buscar_produto();
        select_medida();
        
        $(".selectpicker").selectpicker();
        $('.valor_pro').maskMoney({decimal: '.', thousands: ''});
    });
</script>
