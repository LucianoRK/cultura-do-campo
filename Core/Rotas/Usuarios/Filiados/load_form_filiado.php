<?php include 'Core/Rotas/Usuarios/include_form_usuario.php'; ?>

<?php
$o_coletivo = new Coletivo();
$a_coletivos = $o_coletivo->select_todos_coletivos();
?>
<hr>
<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <label for="nome_fantasia">Nome fantasia</label>
            <input name="nome_fantasia" type="text" class="form-control m-input" placeholder="Nome da empresa">
            <!--<span class="m-form__help">Informe o nome completo</span>-->
        </div>
        <div class="col-md-6">
            <label for="razao_social">Razão social</label>
            <input name="razao_social" type="text" class="form-control m-input" placeholder="Razão social da empresa">
            <!--<span class="m-form__help">Somente números</span>-->
        </div>
    </div>	 
    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <label for="cnpj">CNPJ</label>
            <div class="m-input-icon m-input-icon--right">
                <input id="cnpj" name="cnpj" type="text" class="form-control m-input"  placeholder="Cadastro nacional de pessoa jurídica">
            </div>
        </div>
        <div class="col-md-6">
            <label for="coletivo">Coletivo</label>
            <div class="m-input-icon m-input-icon--right">
                <select name="id_coletivo" data-live-search="" class="form-control selectpicker">
                    <?php if ($a_coletivos) { ?>
                        <?php foreach ($a_coletivos as $value) { ?>
                            <option value="<?php echo $value['id_coletivo']; ?>"><?php echo $value['descricao']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-md-4">
            <label for="fundo_rural">Desconto do fundo rural</label>
            <div class="input-group">
                <input maxlength="2" pattern="/d+" name="fundo_rural" type="text" class="form-control m-input"  placeholder="Porcentagem de desconto do fundo rural">
                <div class="input-group-append"><span class="input-group-text" id="basic-addon2">%</span></div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="fundo_capital">Fundo capital</label>
            <div class="input-group">
                <input maxlength="2" pattern="/d+" name="fundo_capital" type="text" class="form-control m-input"  placeholder="Desconto do fundo capital">
                <div class="input-group-append"><span class="input-group-text" id="basic-addon2">%</span></div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="cota_capital">Cota capital</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">R$</span></div>
                <input maxlength="10" name="cota_capital" type="text" class="form-control m-input valor"  placeholder="Cota capital">
            </div>
        </div>
    </div>
    <?php include 'Core/Rotas/Usuarios/include_form_telefone.php'; ?>

    <?php include 'Core/Rotas/Endereco/include_maps_lat_lng.php'; ?>


    <script>
        $(document).ready(function () {
            $("#cnpj").mask("00.000.000/0000-00");
            $(".selectpicker").selectpicker();
            $('.valor').maskMoney({decimal: ',', thousands: '.'});

        });
    </script>


