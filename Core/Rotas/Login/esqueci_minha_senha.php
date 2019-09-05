<?php
/**
 * Serve para redirecionar o pós-login para a página requisitada
 */
$request_anterior = isset($_SESSION['login_request']) ? $_SESSION['login_request'] : "./";
unset($_SESSION['login_request']);
?>

<style>
    div.g-recaptcha {
        margin: 0 auto!important;
        width: 304px!important;
    }
</style>
<div class="m-login__container animated fadeIn">
    <div class="m-login__logo">
        <a href="login">
            <img class="img-fluid" src="Public/Images/Logo/vertical_logo.png" style="width:350px; height: auto;">
        </a>
    </div>
    <div id="m_blockui_1_content" class="m-login__signin">
        <form id="form_recuperar" class="m-login__form m-form" action="">
            <div class="form-group m-form__group">
                <input class="form-control m-input text-center" type="text" placeholder="Informe seu usuário ou e-mail cadastrado" name="email_usuario">
            </div>
            <br>
            <?php if ($_SERVER['HTTP_HOST'] != 'localhost') { ?>
                <div class="g-recaptcha col-md-12 text-center" data-sitekey="6Len6HYUAAAAAIQH0ddhVjEukzpa0qXmK3iPN4Ss"></div>
            <?php } ?>
            <div class="m-login__form-action">
                <button type="button" id="submit_login" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-success btn-block">Recuperar minha senha</button>     
            </div>
            <div style="display: none;" id="alerta_mensagem" role="alert" class="animated fadeInDown fast m--margin-top-30 alert  alert-dismissible fade show   m-alert m-alert--air m-alert--outline m-alert--outline-2x">
            </div>
        </form>

    </div>

</div>


<script>
    $(document).ready(function () {

        $('#submit_login').on('click', function () {
            executeLogin();
        });
        $('input').on('keydown', function (e) {
            if (e.which == 13) {
                executeLogin();
            }
        });
    });

    function executeLogin() {
        blockPage();
        var formData = $("#form_recuperar").serialize();
        $.ajax({
            type: "post",
            url: "login/recuperar-senha",
            data: formData,
            success: function (json) {
                if (is_json(json)) {
                    var response = JSON.parse(json);
                    if (response.result) {
                        $("#alerta_mensagem").removeClass("alert-danger");
                        $("#alerta_mensagem").addClass("alert-success");
                        $("#alerta_mensagem").html(response.message);
                        $("#alerta_mensagem").show();

                    } else {
                        $("#alerta_mensagem").addClass("alert-danger");
                        $("#alerta_mensagem").html(response.message);
                        $("#alerta_mensagem").show();
                    }
                } else {
                    $("#alerta_mensagem").addClass("alert-danger");
                    $("#alerta_mensagem").html("Ocorreu um erro desconhecido. Tente novamente mais tarde.");
                    $("#alerta_mensagem").show();
                }

                unblockPage();
            },
            error: function (error) {
                alert("Erro: Entre em contato com o suporte (COD: L001)");
            }
        });
    }


</script>

