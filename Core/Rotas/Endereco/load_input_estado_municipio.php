<?php
$o_endereco = new Endereco();

if (strlen($_POST['estado_long']) == 2) {
    $estado_long = $o_endereco->get_nome_from_uf($_POST['estado_long']);
} else {
    $estado_long = $_POST['estado_long'];
}
/**
 * Arquivo usado somente na geolocalização automática ou CEP
 */
?>
<div class="col-md-12">
    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <label>Estado localizado</label>
            <input disabled type="text" class="form-control m-input" value="<?php echo $estado_long; ?>">
        </div>
        <div class="col-md-6">
            <label>Município localizado</label>
            <input disabled type="text" class="form-control m-input" value="<?php echo $_POST['municipio']; ?>">
        </div>
    </div>
</div>
<input style="display: none" readonly="" type="text" class="form-control" name="estado" value="<?php echo $_POST['estado_short']; ?>">
<input style="display: none" readonly="" type="text" class="form-control" name="municipio" value="<?php echo $_POST['municipio']; ?>">
