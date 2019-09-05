<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="m-portlet m-portlet--full-height  ">
            <div class="m-portlet__body">
                <div class="m-card-profile">
                    <!--                    <div class="m-card-profile__pic">
                                            <div class="m-card-profile__pic-wrapper">
                                                <img src="<?php // echo SESSION::get_gravatar();   ?>" alt="">
                                            </div>
                                        </div>-->
                    <div class="m-card-profile__details">
                        <span class="m-card-profile__name"><?php echo SESSION::get_nome_usuario(); ?></span>
                        <a href="" class="m-card-profile__email m-link"><?php echo SESSION::get_tipo_usuario(); ?></a>
                    </div>
                </div>


                <div class="m-portlet__body-separator"></div>
                <div class="m-widget1 m-widget1--paddingless">
                    <?php if (APP::has_permissao(38)) { ?>
                        <div id="dados_perfil" class="m-widget1__item pointer m-widget1--paddingless">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <i class=" flaticon-user text-success"></i>

                                        </div>
                                        <div class="col-md-10">

                                            <h3 class="m-widget1__title">Meu perfil</h3>
                                            <span class="m-widget1__desc">Informações do perfil</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (APP::has_permissao(39)) { ?>

                        <div id="seguranca" class="m-widget1__item pointer">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <i class=" flaticon-internet text-success"></i>
                                        </div>
                                        <div class="col-md-10">
                                            <h3 class="m-widget1__title">Segurança</h3>
                                            <span class="m-widget1__desc">Acessos ao sistema</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                    <?php if (APP::has_permissao(63)) { ?>

                        <div id="matriz_fiscal" class="m-widget1__item pointer">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <i class=" flaticon-file-2  text-success"></i>
                                        </div>
                                        <div class="col-md-10">
                                            <h3 class="m-widget1__title">Matriz Fiscal</h3>
                                            <span class="m-widget1__desc">Dados fiscais da empresa</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                    <?php if (APP::has_permissao(61)) { ?>

                        <div id="endereco" class="m-widget1__item pointer">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <i class=" flaticon-map-location text-success"></i>
                                        </div>
                                        <div class="col-md-10">
                                            <h3 class="m-widget1__title">Endereço</h3>
                                            <span class="m-widget1__desc">Localização do cadastro</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>

                    <?php if (APP::has_permissao(42)) { ?>

                        <div id="suporte" class="m-widget1__item pointer">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <i class=" flaticon-chat-1  text-success"></i>
                                        </div>
                                        <div class="col-md-10">
                                            <h3 class="m-widget1__title">Suporte</h3>
                                            <span class="m-widget1__desc">Entre em contato</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8" id="config_container">

    </div>
</div>


<script>
    $(document).ready(function () {
        blockElement("#config_container");
        $("#config_container").load("usuario/configuracoes/perfil", {}, function () {
            unblockElement("#config_container");

        });


        $("#dados_perfil").off("click");
        $("#dados_perfil").on("click", function () {
            blockElement("#config_container");
            $("#config_container").load("usuario/configuracoes/perfil", {}, function () {
                unblockElement("#config_container");
            });
        });

        $("#seguranca").off("click");
        $("#seguranca").on("click", function () {
            blockElement("#config_container");
            $("#config_container").load("usuario/configuracoes/seguranca", {}, function () {
                unblockElement("#config_container");

            });
        });

        $("#suporte").off("click");
        $("#suporte").on("click", function () {
            blockElement("#config_container");
            $("#config_container").load("usuario/configuracoes/suporte", {}, function () {
                unblockElement("#config_container");
            });
        });

        $("#endereco").off("click");
        $("#endereco").on("click", function () {
            blockElement("#config_container");
            $("#config_container").load("usuario/configuracoes/endereco", {}, function () {
                unblockElement("#config_container");
            });
        });
        $("#matriz_fiscal").off("click");
        $("#matriz_fiscal").on("click", function () {
            carregar_matriz_fiscal();
        });


    });

    function carregar_matriz_fiscal() {
        blockElement("#config_container");
        $("#config_container").load("usuario/configuracoes/fiscal", {}, function () {
            unblockElement("#config_container");
        });
    }
</script>