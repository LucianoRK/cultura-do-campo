<?php
$o_usuario = new Usuario();
$o_agricultor = new Agricultor();
$o_propriedade = new PropriedadeRural();
die('Manutenção');
$id_usuario_agricultor = $_GET['id_usuario_agricultor'];

$usuario = $o_usuario->select_usuario_from_id($id_usuario_agricultor);
$a_telefones = $o_usuario->select_telefones_usuario($id_usuario_agricultor);
$agricultor = $o_agricultor->select_agricultor($id_usuario_agricultor);
$a_propriedade = $o_propriedade->select_propriedades_usuario($id_usuario_agricultor);
?>

<!--        id_propriedade_rural,
                lat,
                lng,
                estados.nome AS estado,
                municipios.nome AS municipio-->

<div class="row">
    <div class="col-md-12">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Informações básicas
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                            <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn-- btn-secondary m-btn m-btn--label-info">
                                Ações
                            </a>
                            <div class="m-dropdown__wrapper" style="z-index: 101;">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 51px;"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">

                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">Nova propriedade</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                        <span class="m-nav__link-text">Adicionar produção</span>
                                                    </a>
                                                </li>

                                                <li class="m-nav__separator m-nav__separator--fit">
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="#" class="btn btn-outline-danger m-btn m-btn-- m-btn--wide btn-sm">Desativar usuário</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-widget12">
                    <div class="m-widget12__item">
                        <span class="m-widget12__text1">Nome completo<br><span><?php echo STRINGS::proper_case($usuario['nome']); ?></span></span>
                        <span class="m-widget12__text2">Identificação<br><span>U<?php echo $usuario['id_usuario']; ?>-A<?php echo $agricultor['id_agricultor']; ?></span></span>
                    </div>
                    <div class="m-widget12__item">
                        <span class="m-widget12__text1">Cadastro de pessoa física<br><span><?php echo $usuario['cpf']; ?></span></span>
                        <span class="m-widget12__text2">Registro geral<br><span><?php echo $agricultor['rg']; ?></span></span>
                    </div>
                    <div class="m-widget12__item">
                        <span class="m-widget12__text1">CAEPF<br><span><?php echo $agricultor['caepf']; ?></span></span>
                        <span class="m-widget12__text2">E-Mail<br><span><?php echo $usuario['email']; ?></span></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Telefones
                        </h3>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body">
                <div class="m-widget6">
                    <div class="m-widget6__head">
                        <div class="m-widget6__item">
                            <span class="m-widget6__caption">
                                Tipo
                            </span>
                            <span class="m-widget6__caption m--align-left">
                                Amount
                            </span>

                        </div>
                    </div>
                    <div class="m-widget6__body">
                        <?php if ($a_telefones) { ?>

                            <?php foreach ($a_telefones as $value) { ?>

                                <div class="m-widget6__item">
                                    <span class="m-widget6__text">
                                        <?php
                                        if ($value['tipo_telefone'] == 1) {
                                            echo "Celular/WhatsApp";
                                        } else {
                                            echo "Telefone fixo";
                                        }
                                        ?>
                                    </span>

                                    <span class="m-widget6__text m--align-left m--font-boldest m--font-brand">
                                        <?php echo $value['telefone']; ?>
                                    </span>
                                </div>
                            <?php } ?>

                        <?php } ?>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>