<?php
    $obj_estoque = new Estoque();
    if(isset($_SESSION['id_filiado'])){
        $estoque_array = $obj_estoque->list_estoque_filial($_SESSION['id_filiado']);
    }else{
        $estoque_array = false;
    }
    
    
   
?>
<?php if($estoque_array){ ?>
    <table class="table table-bordered table-hover table-bordered" id="estoque_table">
        <thead>
            <tr>
                <th class="text-center">Cod. produto</th>
                <th class="text-center">Produto</th>
                <th class="text-center">Quantidade</th>
                <th class="text-center">Valor uni.</th>
                <th class="text-center">Tipo uni.</th>
                <th class="text-center">Ações. </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estoque_array as $estoque) {?>
                <tr>
                    <td class="text-center" title="Código ncm: <?php echo $estoque['ncm_codigo']; ?>">  
                        <?php echo $estoque['id_estoque']; ?>                 
                    </td>
                    <td class="text-left">  
                        <?php 
                            if($estoque['nome']){ 
                                echo $estoque['nome'];
                            }else{
                                echo $estoque['ncm_descricao'];
                            };
                        ?>
                    </td>
                    <td class="text-center">  
                       <?php echo $estoque['quantidade'] ?>
                    </td>
                    <td class="text-center">  
                        <?php echo $estoque['preco_unidade'] ?>
                    </td>
                    <td class="text-center">  
                       <?php echo $estoque['descricao'] ?>
                    </td>
                    <td class="text-center">  
                       
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table> 
<?php } ?>
<script>
    $(document).ready(function () {
          $('#estoque_table').DataTable({
            "order": [],
            "paging": true,
            pageLength: 30
        });
    });
</script>
