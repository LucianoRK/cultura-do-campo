
    <div class="col-md-12">
        <div class="form-group m-form__group row">
            <div class="col-md-6">
                <label>Nome fantasia</label>
                <input name="nome_fantasia" type="text" class="form-control m-input" value="" placeholder="Nome Fantasia">
            </div>

            <div class="col-md-6">
                <label>Razão social</label>
                <input name="razao_social" type="text" class="form-control m-input" value="" placeholder="Razão Social">
            </div>
         </div>
         <div class="form-group m-form__group row">
            <div class="col-md-6">
                <label>CNPJ</label>
                <input name="cnpj" id="cnpj" type="text" class="form-control m-input" value="" placeholder="CNPJ">
            </div>
         </div>
        
        <?php include 'Core/Rotas/Usuarios/include_form_telefone.php'; ?>
        
        <div class="form-group m-form__group row">
            <div class="col-md-4">
                <label> Banco </label>
                <input name="banco" type="text" class="form-control m-input" value="" placeholder="Banco">
            </div>
             
            <div class="col-md-4">
                <label> Agencia </label>
                <input name="agencia" type="text" class="form-control m-input" value="" placeholder="Agencia">
            </div>

            <div class="col-md-4">
                <label> Conta </label>
                <input name="conta" type="text" class="form-control m-input" value="" placeholder="Conta">
            </div>
        </div>
    </div>

    <?php include 'Core/Rotas/Endereco/include_endereco_completo.php'; ?>
    
<script>
    $(document).ready(function () { 
        $('#cnpj').mask("99.999.999/9999-99", {reverse: true});
    });
</script>