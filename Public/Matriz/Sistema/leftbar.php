

<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item m-aside-left  m-aside-left--skin-light ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow list-unstyled">


            <li id="1" class="m-menu__section m-menu__section--first">
                <h4 class="m-menu__section-text  ">Controle</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            <?php if (APP::has_permissao(8)) { ?>
                <li class="m-menu__item " menu="1">
                    <a href="inicio" class="m-menu__link ">
                        <i class=" m-menu__link-icon  flaticon-dashboard"></i>
                        <span class="m-menu__link-text  ">Início</span>
                    </a>
                </li>
            <?php } ?>

            <li menu="1" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon  flaticon-share  "></i>
                    <span class="m-menu__link-text  ">Associados</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;" m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(53)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="associados/novo" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Novo associado</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>

            <?php if (APP::has_permissao(13)) { ?>
                <li class="m-menu__item " menu="1">
                    <a href="producao/cadastro" class="m-menu__link ">
                        <i class=" m-menu__link-icon    flaticon-open-box   "></i>
                        <span class="m-menu__link-text  ">Produção</span>
                    </a>
                </li>
            <?php } ?>


            <li menu="1" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-map-location "></i>
                    <span class="m-menu__link-text  ">Propriedades</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;" m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(47)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="propriedade/nova" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Nova propriedade</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(48)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="javascript:alert('Ainda não');" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Visão aérea</span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>
            <li menu="1" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-cart"></i>
                    <span class="m-menu__link-text  ">Compras</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(27)) { ?>
                            <li class="m-menu__item" aria-haspopup="true">
                                <a href="compra/nova" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Realizar Compra</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(27)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="listagem/compras" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Lista de Compras</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>

                </div>
            </li>
                   <li menu="1" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-bag"></i>
                    <span class="m-menu__link-text  ">Vendas</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(28)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="venda" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Realizar Venda</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (APP::has_permissao(28)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="#" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Lista de Vendas</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li menu="1" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-analytics"></i>
                    <span class="m-menu__link-text  ">Estoque</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(55)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="estoque" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Ver estoque</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            
            <li menu="1" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-user-add"></i>
                    <span class="m-menu__link-text  ">Fornecedores</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(56)) { ?>
                            <li class="m-menu__item" aria-haspopup="true">
                                <a href="fornecedor" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Cadastro</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(56)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="listar/fornecedor" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Listar</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>

                </div>
            </li>
            
            <li id="3" class="m-menu__section m-menu__section--first">
                <h4 class="m-menu__section-text">Sistema</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            <?php if (APP::has_permissao(31)) { ?>
                <li class="m-menu__item " menu="3">
                    <a href="sistema/github/issues" class="m-menu__link ">
                        <i class=" m-menu__link-icon   flaticon-book  "></i>
                        <span class="m-menu__link-text  ">Github Issues</span>
                    </a>
                </li>
            <?php } ?>
            <li menu="3" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon  flaticon-infinity    "></i>
                    <span class="m-menu__link-text  ">Rotas de acesso</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(1)) { ?>
                            <li class="m-menu__item" aria-haspopup="true">
                                <a href="sistema/rotas/adicionar" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Nova rota</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(17)) { ?>

                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="sistema/rotas/lista" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Todas as rotas</span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>
            <?php if (APP::has_permissao(7)) { ?>
                <li class="m-menu__item " menu="3">
                    <a href="sistema/permissoes" class="m-menu__link ">
                        <i class=" m-menu__link-icon  flaticon-lock "></i>
                        <span class="m-menu__link-text  ">Permissões de acesso</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (APP::has_permissao(52)) { ?>
                <li class="m-menu__item " menu="3">
                    <a href="sistema/docs" class="m-menu__link ">
                        <i class=" m-menu__link-icon flaticon-file "></i>
                        <span class="m-menu__link-text  ">Documentação</span>
                    </a>
                </li>
            <?php } ?>



            <li id="2" class="m-menu__section m-menu__section--first">
                <h4 class="m-menu__section-text  ">Usuários</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>


            <li menu="2" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon   flaticon-user-settings"></i>
                    <span class="m-menu__link-text  ">Coordernadores</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <?php if (APP::has_permissao(11)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuarios/cadastro/coordenador" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Novo coordenador</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(34)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuarios/lista/coordenadores" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Meus coordenadores</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>





            <li menu="2" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon   flaticon-users "></i>
                    <span class="m-menu__link-text  ">Técnicos</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <?php if (APP::has_permissao(12)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuarios/cadastro/tecnico" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Novo técnico</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(15)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuarios/lista/tecnicos" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Técnicos disponíveis</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>

            <li menu="2" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon   flaticon-avatar   "></i>
                    <span class="m-menu__link-text  ">Agricultores</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;" m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(2)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuarios/cadastro/agricultor" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Novo agricultor</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(14)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuarios/lista/agricultores" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Exibir todos</span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>




            <li menu="2" class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon  flaticon-suitcase   "></i>
                    <span class="m-menu__link-text  ">Filiados</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu " style="display: none; overflow: hidden;"
                     m-hidden-height="80"><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <?php if (APP::has_permissao(20)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuario/cadastro/filiado" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Novo filiado</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (APP::has_permissao(21)) { ?>
                            <li class="m-menu__item " aria-haspopup="true">
                                <a href="usuario/lista/filiados" class="m-menu__link ">
                                    <i class="m-menu__link-bullet"><span></span>
                                    </i><span class="m-menu__link-text ">Meus filiados</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>

        

     






        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>


<script>
    $(document).ready(function () {

        var pathname = '<?php echo $rota['pathname']; ?>';




        $(".m-menu__subnav").each(function () {
            var menu = $(this);
            var count = menu.find("li").length;
            if (count === 0) {
                menu.closest(".m-menu__item--submenu").remove();
            }
        });

        $(".m-menu__section").each(function () {
            var section = $(this);
            var menu = section.attr("id");
            var items = $("li[menu=" + menu + "]");
            if (items.length === 0) {
                section.hide();
            }
        });

        $(".m-menu__item").each(function () {
            var item = $(this);
            var href = item.find("a").attr("href");
            if (item.parent(".m-menu__subnav").length > 0) {
                var subnav = item.parent(".m-menu__subnav");
                var qtde_li = subnav.find("li").length;
                subnav.parent().attr("m-hidden-height", qtde_li * 40)
                if (href == pathname) {
                    subnav.parent().parent().addClass("m-menu__item--open");
                    subnav.parent().show();
                }
            } else {
                if (href == pathname) {
                    item.addClass("active_menu");
                }
            }
        });


    });
</script>

