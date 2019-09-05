<footer class="m-grid__item m-footer ">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-footer__wrapper">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                    <span class="m-footer__copyright">
                        <?php echo date("Y"); ?> &copy; <span class="text-dark">Cultura do Campo </span> 
                        <span class="text-primary">[<?php echo SESSION::get_tipo_usuario(); ?>]</span>
                    </span>
                </div>
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                    <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                        <?php
                        if (APP::has_permissao(37) || APP::is_localhost()) {
                            ?>
                            <li class="m-nav__item">
                                <a href="http://culturadocampo.com.br/metronic/theme/classic/demos/default/" target="_blank" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        <u>Abrir tema</u>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>

                        <li class="m-nav__item">
                            <a class="m-nav__link">
                                <span class="m-nav__link-text text-dark">
                                    <?php
                                    if (SESSION::get_id_tipo_usuario() == 3) {
                                        echo STRINGS::proper_case($_SESSION['nome_fantasia']);
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <?php
                        if (APP::has_permissao(33) || APP::is_localhost()) {
                            ?>
                            <li class="m-nav__item">
                                <a class="m-nav__link">
                                    <span class="m-nav__link-text text-primary">
                                        <?php echo $rota['conteudo']; ?> (Ctrl+Espaço)
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="m-nav__item">
                            <a class="m-nav__link">
                                <span class="m-nav__link-text text-primary">
                                    U<?php echo SESSION::get_id_usuario(); ?>-T<?php echo SESSION::get_id_tipo_usuario(); ?>-R<?php echo $rota['id_rota']; ?>
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="javascript:alert('Suporte em desenvolvimento');" class="m-nav__link" data-toggle="m-tooltip" title="Suporte" data-placement="left">
                                <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .md-modal {
        margin: auto;
        position: fixed;
        top: 100px;
        left: 0;
        right: 0;
        width: 50%;
        max-width: 630px;
        min-width: 320px;
        height: auto;
        z-index: 2000;
        visibility: hidden;
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .md-modal pre{
        color:white;
    }
    .md-show {
        visibility: visible;
    }

    .md-overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        visibility: hidden;
        top: 0;
        left: 0;
        z-index: 1000;
        opacity: 0;
        background: black;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .md-show ~ .md-overlay {
        opacity: 1;
        visibility: visible;
    }

    .md-effect-12 .md-content {
        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
        opacity: 0;
        -webkit-transition: all .20s;
        -moz-transition: all .20s;
        transition: all .20s;
        color: white;
    }

    .md-show.md-effect-12 ~ .md-overlay {
        background-color: rgba(0,0,0,.75);
    }

    .md-effect-12 .md-content h3,
    .md-effect-12 .md-content {
        background: transparent;
    }

    .md-show.md-effect-12 .md-content {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        opacity: 1;
    }
    #myUL {
        list-style-type: none;
        padding: 0;
        margin: 0;
        max-height: 600px;
    }

    #myUL li a {
        border: 1px solid #ddd;
        margin-top: -1px; /* Prevent double borders */
        background-color: #f6f6f6;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        color: black;
        display: block
    }

    #myUL li a:hover:not(.header) {
        background-color: #eee;
    }
</style>

<div class="md-modal md-effect-12">
    <div class="md-content">
        <div class="col-md-12">

            <h3>Router</h3>
            <p>Informativo das rotas do sistema</p>
        </div>

        <div>
            <div class="col-md-12">

                <strong>Rota atual:</strong>  <?php echo $rota['conteudo']; ?> [<?php echo $rota['id_rota']; ?>]
            </div>
            <div class="col-md-12">

                <input id="term_localizar_rota" style="background: rgba(255,255,255,1)" class="form-control" type="text" placeholder="Nome da rota ou arquivo php">
            </div>
            <div class="col-md-12" id="result_busca_rota">
            </div>
        </div>
    </div>
</div>


<div class="md-overlay"></div>

<script>
    $(document).ready(function () {
        $(".selectpicker").selectpicker();
//        $('.md-modal').toggleClass('md-show');

        window.onkeydown = function (e) {
            if (e.ctrlKey && e.keyCode == 32) {
                $('.md-modal').toggleClass('md-show');
                setTimeout(function () {
                    $("#term_localizar_rota").focus();
                }, 100);
            }
        };


        $("#term_localizar_rota").off("input");
        $("#term_localizar_rota").on("input", function () {
            var value = $(this).val();
            $("#result_busca_rota").load("rota/localizar", {term: value});
        });

    });
</script>
