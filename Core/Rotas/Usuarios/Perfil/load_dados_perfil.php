<?php
$o_usuario  = new Usuario();
$id_usuario = SESSION::get_id_usuario();
$usuario    = $o_usuario->select_usuario_from_id($id_usuario);
?>

<div class="m-portlet m-portlet--full-height fixed_footer">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Meu perfil
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form class="m-form">
        <div class="m-portlet__body">
            <div class="m-widget4" >
                <div class="m-widget4__item" style="width:100%">
                    <div class="m-widget4__ext ">
                        <span class="m-widget4__icon m--font-brand">
                            <i class="flaticon-more-v5 text-success"></i>
                        </span>
                    </div>
                    <div class="m-widget4__info" style="width: 50%;">
                        <span class="m-widget4__text">
                            Nome completo
                        </span>
                    </div>
                    <div class="m-widget4__ext text-right" style="width: 50%;">
                        <span class="m-widget4__number m--font-info ">
                            <?php echo SESSION::get_nome_usuario(); ?>
                        </span>
                    </div>
                </div>
                <div class="m-widget4__item">
                    <div class="m-widget4__ext">
                        <span class="m-widget4__icon m--font-brand">
                            <i class="flaticon-more-v5 text-success"></i>
                        </span>
                    </div>
                    <div class="m-widget4__info">
                        <span class="m-widget4__text">
                            E-mail
                        </span>
                    </div>
                    <div class="m-widget4__ext text-right" style="width: 50%;">
                        <span class="m-widget4__number m--font-info ">
                            <?php echo $usuario['email']; ?>
                        </span>
                    </div>
                </div>
                <div class="m-widget4__item">
                    <div class="m-widget4__ext">
                        <span class="m-widget4__icon m--font-brand">
                            <i class="flaticon-more-v5 text-success"></i>
                        </span>
                    </div>
                    <div class="m-widget4__info">
                        <span class="m-widget4__text">
                            CPF
                        </span>
                    </div>
                    <div class="m-widget4__ext text-right">
                        <span class="m-widget4__number m--font-info">
                            <?php echo $usuario['cpf']; ?>
                        </span>
                    </div>
                </div>
                <div class="m-widget4__item">
                    <div class="m-widget4__ext">
                        <span class="m-widget4__icon m--font-brand">
                            <i class="flaticon-more-v5 text-success"></i>
                        </span>
                    </div>
                    <div class="m-widget4__info">
                        <span class="m-widget4__text">
                            Cadastro
                        </span>
                    </div>
                    <div class="m-widget4__ext text-right">
                        <span class="m-widget4__number m--font-info">
                            <?php echo DATE::mysql_to_date($usuario['data_cadastro']); ?>
                        </span>
                    </div>
                </div>

            </div>
        </div>
<!--        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                <button type="reset" class="btn btn-brand">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>-->
    </form>

</div>



