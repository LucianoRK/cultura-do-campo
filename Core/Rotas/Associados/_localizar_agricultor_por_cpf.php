<?php
$o_agricultor = new Agricultor();
$o_usuario = new Usuario();

$cpf = STRINGS::limpar($_POST['cpf']);
$agricultor = $o_agricultor->localizar_agricultor_por_cpf($cpf);
?>

<?php if ($agricultor) { ?>

    <div class="form-group m-form__group">


        <input name="id_agricultor" type="hidden" value="<?php echo $agricultor['id_agricultor']; ?>">
        <div class="col-md-12">

            <div class="row">
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class=" flaticon-user-ok "></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        <strong style="font-size: 22px; font-weight: 300; color: black"><?php echo STRINGS::proper_case($agricultor['nome']); ?></strong>
                        <br>
                        <small class="text-muted">CAEPF: <?php echo $agricultor['caepf'] ? $agricultor['caepf'] : 'Não informado'; ?></small>
                    </div>

                </div>


            </div>

        </div>

    </div>

<?php } else { ?>
    <div class="form-group m-form__group">
        <div class="col-md-12">
            <div class="row">
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation-1"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        <strong>Nenhum agricultor foi encontrado com este CPF.</strong>
                        <a style="margin-left: 8px; margin-top: 10px" href="usuarios/cadastro/agricultor" target="_blank"><u> Cadastrar novo agricultor?</u></a>

                    </div>

                </div>


            </div>
        </div>

    </div>
<?php } ?>

