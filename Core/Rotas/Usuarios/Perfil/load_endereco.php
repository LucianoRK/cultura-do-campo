<?php
$o_endereco = new Endereco();
$endereco = $o_endereco->select_endereco(SESSION::get_meu_id_endereco());
?>




<div class="m-portlet m-portlet--full-height   ">

    <div class="tab-content">
        <div class="tab-pane active show" id="m_user_profile_tab_1">
            <form class="m-form m-form--fit m-form--label-align-right">

                <div  class="m-portlet__body">


                    <div class="m-widget4" style="padding: 32px">
                        <div class="m-widget4__item" style="width:100%">
                            <div class="m-widget4__ext ">
                                <span class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-more-v5 text-success"></i>
                                </span>
                            </div>
                            <div class="m-widget4__info" style="width: 50%;">
                                <span class="m-widget4__text">
                                    Estado
                                </span>
                            </div>
                            <div class="m-widget4__ext text-right" style="width: 50%;">
                                <span class="m-widget4__number m--font-info ">
                                    <?php echo $endereco['estado']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="m-widget4__item" style="width:100%">
                            <div class="m-widget4__ext ">
                                <span class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-more-v5 text-success"></i>
                                </span>
                            </div>
                            <div class="m-widget4__info" style="width: 50%;">
                                <span class="m-widget4__text">
                                    Cidade
                                </span>
                            </div>
                            <div class="m-widget4__ext text-right" style="width: 50%;">
                                <span class="m-widget4__number m--font-info ">
                                    <?php echo $endereco['municipio']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="m-widget4__item" style="width:100%">
                            <div class="m-widget4__ext ">
                                <span class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-more-v5 text-success"></i>
                                </span>
                            </div>
                            <div class="m-widget4__info" style="width: 50%;">
                                <span class="m-widget4__text">
                                    CEP
                                </span>
                            </div>
                            <div class="m-widget4__ext text-right" style="width: 50%;">
                                <span class="m-widget4__number m--font-info ">
                                    <?php echo $endereco['cep']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="m-widget4__item" style="width:100%">
                            <div class="m-widget4__ext ">
                                <span class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-more-v5 text-success"></i>
                                </span>
                            </div>
                            <div class="m-widget4__info" style="width: 50%;">
                                <span class="m-widget4__text">
                                    Bairro
                                </span>
                            </div>
                            <div class="m-widget4__ext text-right" style="width: 50%;">
                                <span class="m-widget4__number m--font-info ">
                                    <?php echo $endereco['bairro']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="m-widget4__item" style="width:100%">
                            <div class="m-widget4__ext ">
                                <span class="m-widget4__icon m--font-brand">
                                    <i class="flaticon-more-v5 text-success"></i>
                                </span>
                            </div>
                            <div class="m-widget4__info" style="width: 50%;">
                                <span class="m-widget4__text">
                                    Logradouro
                                </span>
                            </div>
                            <div class="m-widget4__ext text-right" style="width: 50%;">
                                <span class="m-widget4__number m--font-info ">
                                    <?php echo $endereco['logradouro']; ?>, <?php echo $endereco['numero']; ?>
                                </span>
                            </div>
                        </div>
                    </div>


                </div>

            </form>
        </div>

    </div>
</div>



