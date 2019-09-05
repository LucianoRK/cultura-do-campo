<?php
    $filiado = SESSION::get_id_filiado();
    $o_fornecedor = new Fornecedor();
    $fornecedores = $o_fornecedor->select_todos_fornecedores($filiado);
?>  

<table class="table table-bordered table-hover table-bordered" id="tabela_fornecedores">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nome Fantasia</th>
            <th class="text-center">Razão Social</th>
            <th class="text-center">CNPJ</th>
            <th class="text-center">-</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($fornecedores as $fornecedor){ ?>
            <tr>
                <td class="text-center">  
                    <?php echo $fornecedor['id_fornecedor']; ?>
                </td>
                <td class="text-center">  
                    <?php echo $fornecedor['nome_fantasia']; ?>
                </td>
                <td class="text-center">  
                    <?php echo $fornecedor['razao_social']; ?>
                </td>
                <td class="text-center">  
                    <?php echo $fornecedor['cnpj']; ?>
                </td>
                <td class="text-center" id_fornecedor="<?php echo $fornecedor['id_fornecedor']; ?>">  
                    <button type="button" class="btn btn-primary btn-sm editar" title="Editar"> <i class="flaticon-edit"></i> </button>
                    <button type="button" class="btn btn-danger btn-sm excluir" title="Excluir"> <i class="flaticon-delete"></i> </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function inativar_fornecedor(){
        $(".excluir").on("click", function(){
            if(confirm("Deseja excluir fornecedor ?")) {
                let id_fornecedor = $(this).parent().attr("id_fornecedor");

                $.ajax({
                    type: "post",
                    url: "inativar/fornecedor",
                    data: {fornecedor: id_fornecedor},
                    success: function (response) {
                        lerResposta(response, load_form);
                    }
                });
            }
        });
    }
    
    function editar_fornecedor(){
        $(".editar").on("click", function(){
            let id_fornecedor = $(this).parent().attr("id_fornecedor");
            
            $("#lista_fornecedores").load("form/update/fornecedor", {editar_fornecedor:id_fornecedor}, function () {
                unblockPage();
            });
        });
    }
    
    $(document).ready(function () {  
        inativar_fornecedor();
        editar_fornecedor();
    });
</script>