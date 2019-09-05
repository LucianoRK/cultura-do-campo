<?php
    if(isset($_POST['array_produtos'])){
        $dados = $_POST['array_produtos'];
        $count = 0;
    }else{
        $dados  = false;
    }
?>

    <!--begin: Datatable -->
    <?php if ($dados) { ?>
        <table class="table table-bordered table-hover table-bordered" id="rotas_table">
            <thead>
                <tr>
                    <th class="text-center"> - </th>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Produto</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">QTD</th>
                    <th class="text-center">Valor p/ Unid. ou KG</th>
                    <th class="text-center">Valor Total</th>
                    <th class="text-center">Excluir Prod. </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dados as $value){
                    $o_nomeCategoria = new CategoriaProdutos();
                    $nomeCat = $o_nomeCategoria->select_categoria($value['categoria']);
                    
                    $o_nomeProduto = new Produto();
                    $nomeProd = $o_nomeProduto->select_produto($value['produto']);
                ?>
                    <tr>
                        <td class="text-center">  
                            <p> <?php echo $count; ?> </p>
                        </td>
                        <td class="text-center">  
                            <p> <?php echo $nomeCat['nome']; ?> </p>
                        </td>
                        <td class="text-center">  
                           <p> <?php echo $nomeProd['nome']; ?> </p>
                        </td>
                        <td class="text-center">  
                            <p> <?php echo MEDIDAS_PRODUTOS::getMedidasProd($value['medida']); ?> </p>
                        </td>
                        <td class="text-center">  
                           <p> <?php echo $value['qtd']; ?> </p>
                        </td>
                        <td class="text-center">  
                           <p> R$ <?php echo $value['valor']; ?> </p>
                        </td>
                        <td class="text-center">  
                           <p> R$ <?php echo MOEDA::int_to_mysql($value['valor'] * $value['qtd']); ?> </p>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm excluir_compra" id_compra="<?php echo $count; ?>" type="button"><span class="flaticon-delete"></span></button>
                        </td>
                    </tr>
                <?php $count++; } ?>
            </tbody>
        </table>
        <div id="valor_total_compra" class="text-right">
            
        </div>
    <?php } ?>
    
    
<script>
    function excluir_produto(){
        $(".excluir_compra").off("click");
        $(".excluir_compra").on("click", function () {
            let id_compra   = $(this).attr("id_compra");
            
            // Deleto o pedido selecionado
            for(let i=0; i < array_produtos.length; i++) {
                if(i == id_compra){
                    array_produtos.splice(i, 1);
                }
            }
            
            $("#compra_tabela").load("compra/tabela", {array_produtos: array_produtos}, function () {});
            return false;
        });
    }
    
    function soma_produtos(){
        var valor_total = 0;
        
        for(let i=0; i < array_produtos.length; i++) {  
            valor  = parseFloat(array_produtos[i]['valor']);
            valor2 = parseFloat(valor_total);
            valor_total = valor2 + (valor * array_produtos[i]['qtd']);
        }
        
        dados_extra['valor_total'] = valor_total;
        valor_total =  "TOTAL: R$ " + valor_total.toFixed(2);
        $("#valor_total_compra").html(valor_total);
    }
    
    $(document).ready(function () {
        excluir_produto();
        soma_produtos();
    });
</script>
