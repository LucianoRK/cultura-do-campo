

<?php
$id_tipo_usuario = SESSION::get_id_tipo_usuario();
?>

<?php if ($id_tipo_usuario <> 2) { ?>
    <div class="col-md-12">
        <div class="form-group m-form__group row">
            <div class="col-md-12">
            <label for="rg">Coordenador responsável</label>

                <?php
                $o_coordenador = new Coordenador();
                $coordenadores = $o_coordenador->select_coordenadores();
                ?>
                <select data-style="btn-outline-info" name="id_usuario_coordenador" class="form-control selectpicker">

                    <?php if ($coordenadores) { ?>
                        <option selected>Selecione o coordenador responsável por este técnico</option>
                        <?php foreach ($coordenadores as $value) { ?>
                            <option  value="<?php echo $value['id_usuario']; ?>"><?php echo $value['nome']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
<?php } ?>
<?php include 'Core/Rotas/Usuarios/include_form_usuario.php'; ?>
<?php include 'Core/Rotas/Usuarios/include_form_telefone.php'; ?>
<?php include 'Core/Rotas/Endereco/include_select_estado.php'; ?>

<div class="col-md-12">


    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <label for="rg">RG</label>
            <input pattern="\d+" name="rg" type="text" class="form-control m-input" placeholder="RG do usuário">
            <span class="m-form__help">Somente números</span>
        </div>
        <div class="col-md-6">

            <label for="formacao">Formação</label>
            <input name="formacao" type="text" class="form-control m-input" placeholder="Formação do técnico">
            <span class="m-form__help">Informe a formação do técnico</span>

        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-md-6">
            <label for="area_atuacao">Área de atuação</label>
            <input name="area_atuacao" type="text" class="form-control m-input" placeholder="Qual a área de atuação do técnico?">
            <span class="m-form__help">Área de atuação do técnico</span>
        </div>
        <div class="col-md-6">
            <label for="entidade">Entidade</label>
            <input name="entidade" type="text" class="form-control m-input" placeholder="Entidade a qual ele pertence">
            <span class="m-form__help">Informe a entidade a qual ele pertence</span>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-md-12">
            <label for="observacao">Observações: (Opcional)</label>
            <textarea style="resize: none;" name="observacao" type="text" class="form-control m-input" placeholder="Qualquer observação, opcional." rows="5"></textarea>
            <span class="m-form__help">Qualquer comentário necessário para este técnico</span>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".selectpicker").selectpicker();
    });
</script>