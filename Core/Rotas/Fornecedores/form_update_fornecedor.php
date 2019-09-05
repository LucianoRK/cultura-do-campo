<?php 
    if(isset($_POST['editar_fornecedor']) && !empty($_POST['editar_fornecedor'])){
        $id_fornecedor = $_POST['editar_fornecedor'];
                
        $o_fornecedor = new Fornecedor();
        $fornecedor = $o_fornecedor->select_fornecedor($id_fornecedor);
        $id_endereco = $o_fornecedor->select_fornecedor($id_fornecedor);
        
        $o_banco = new ContaBancaria();
        $banco = $o_banco->select_conta_bancaria($id_fornecedor);
        
        $o_endereco = new Endereco();
        $endereco = $o_endereco->select_endereco($id_endereco['fk_endereco']);

    }
?>
    <div class="col-md-12">
        <div class="form-group m-form__group row">
            <div class="col-md-6">
                <label>Nome fantasia</label>
                <input name="nome_fantasia" type="text" class="form-control m-input" value="<?php if(isset($fornecedor['nome_fantasia'])){ echo $fornecedor['nome_fantasia']; }?>" placeholder="Nome Fantasia">
            </div>

            <div class="col-md-6">
                <label>Razão social</label>
                <input name="razao_social" type="text" class="form-control m-input" value="<?php if(isset($fornecedor['razao_social'])){ echo $fornecedor['razao_social']; }?>" placeholder="Razão Social">
            </div>
         </div>
         <div class="form-group m-form__group row">
            <div class="col-md-6">
                <label>CNPJ</label>
                <input name="cnpj" disabled="" id="cnpj" type="text" class="form-control m-input" value="<?php if(isset($fornecedor['cnpj'])){ echo $fornecedor['cnpj']; }?>" placeholder="CNPJ">
            </div>
         </div>
        
        <?php include 'Core/Rotas/Usuarios/include_form_telefone.php'; ?>
        
        <div class="form-group m-form__group row">
            <div class="col-md-4">
                <label> Banco </label>
                <input name="banco" type="text" class="form-control m-input" value="<?php if(isset($banco['banco'])){ echo $banco['banco']; }?>" placeholder="Banco">
            </div>
             
            <div class="col-md-4">
                <label> Agencia </label>
                <input name="agencia" type="text" class="form-control m-input" value="<?php if(isset($banco['agencia'])){ echo $banco['agencia']; }?>" placeholder="Agencia">
            </div>

            <div class="col-md-4">
                <label> Conta </label>
                <input name="conta" type="text" class="form-control m-input" value="<?php if(isset($banco['conta'])){ echo $banco['conta']; }?>" placeholder="Conta">
            </div>
        </div>
        
    </div>

    <input type="hidden" name="id_endereco" value="<?php if(isset($fornecedor['fk_endereco'])){ echo $fornecedor['fk_endereco']; }?>">
    <input type="hidden" name="id_fornecedor" value="<?php if(isset($id_fornecedor)){ echo $id_fornecedor; }?>">
    <input type="hidden" name="id_conta_bancaria" value="<?php if(isset($banco['id_conta_bancaria'])){ echo $banco['id_conta_bancaria']; }?>">

    <?php include 'Core/Rotas/Endereco/include_endereco_completo.php'; ?>

    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
        <div class="m-form__actions m-form__actions--solid">
            <div class="row">
                <div class="m--align-right col-md-12" style="position: initial;">
                    <button id="salvar_edicao_fornecedor" type="button" class="btn btn-success">Salvar </button>
                </div>
            </div>
        </div>
    </div>
    
<script>
    function salvar_edicao_fornecedor(){
        $("#salvar_edicao_fornecedor").on("click", function(){
            var formData = $("#form_fornecedor").serialize();
        
            $.ajax({
                type: "post",
                url: "salvar/edicao/fornecedor",
                data: formData,
                success: function (response) {
                    lerResposta(response, load_form);
                }
            });
        });
    }
    
    $(document).ready(function () { 
        salvar_edicao_fornecedor();
        $('#cnpj').mask("99.999.999/9999-99", {reverse: true});
    });
</script>