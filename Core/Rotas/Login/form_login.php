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
        <a href="#">
            <img class="img-fluid" src="Public/Images/Logo/vertical_logo.png" style="width:350px; height: auto;">
        </a>
    </div>
    <div id="m_blockui_1_content" class="m-login__signin">
        <form id="form_login" class="m-login__form m-form" action="">
            <input name="g-recaptcha-response" type="hidden">

            <div class="form-group m-form__group">
                <input class="form-control m-input text-center" type="text" placeholder="Usuário ou e-mail" name="usuario">
            </div>
            <div class="form-group m-form__group text-center">
                <input id="input_senha" class="form-control m-input text-center" type="password" placeholder="Senha de acesso" name="senha">
                <span style="display: none;" id="alerta_caps_lock" class="m-form__help text-danger">CAPS LOCK está ativado.</span>
            </div>
            <div class="row m-login__form-sub m--margin-top-20">
                <div class="col m--align-left m-login__form-left">
                    <label class="m-checkbox m-checkbox--focus">
                        <input type="checkbox" name="remember_me"> Lembrar por <?php echo round(CONFIG::$LOGIN_COOKIE_LIFETIME / 3600); ?>h
                        <span></span>
                    </label>
                </div>
                <div class="col m--align-right m-login__form-right">
                    <a href="login/esqueci" id="m_login_forget_password" class="m-link">Esqueceu sua senha?</a>
                </div>
            </div>
            <div class="m-login__form-action">
                <button type="button" id="submit_login" class="btn m-btn m-btn--gradient-from-info m-btn--gradient-to-info btn-block">Acessar plataforma</button>     
            </div>
            <div style="display: none;" id="alert_login_invalido" role="alert" class="text-center animated fadeInDown fast m--margin-top-30 alert  alert-dismissible fade show   m-alert m-alert--air m-alert--outline m-alert--outline-2x">
            </div>
        </form>

    </div>

</div>


<script>
    $(document).ready(function () {

        execute_captcha();

        /**
         * Atualiza o token do recaptcha
         * a cada minuto
         */
        setInterval(function () {
            execute_captcha();
        }, 60000);
        $('#submit_login').on('click', function () {
            executeLogin();
        });
        $('input').on('keydown', function (e) {
            if (e.which == 13) {
                executeLogin();
            }
        });

        $('#input_senha').on("keydown", function (event) {
            if (event.originalEvent.getModifierState("CapsLock")) {
                $("#alerta_caps_lock").show();
            } else {
                $("#alerta_caps_lock").hide();
            }
        });
    });

    function executeLogin() {
        blockPage();
        var formData = $("#form_login").serialize();
        $.ajax({
            type: "post",
            url: "login/_login",
            data: formData,
            success: function (json) {
                execute_captcha();
                var response = JSON.parse(json);
                if (response.result) {
                    $("#alert_login_invalido").removeClass("alert-danger");
                    $("#alert_login_invalido").addClass("alert-success");
                    $("#alert_login_invalido").html(response.message);
                    $("#alert_login_invalido").show();
                    window.location = '<?php echo $request_anterior; ?>';
                } else {
                    $("#alert_login_invalido").addClass("alert-danger");
                    $("#alert_login_invalido").html(response.message);
                    $("#alert_login_invalido").show();
                }
                unblockPage();
            },
            error: function (error) {
                alert("Erro: Entre em contato com o suporte (COD: L001)");
            }
        });
    }

    function execute_captcha() {
        grecaptcha.ready(function () {
            grecaptcha.execute('6Le8m4QUAAAAAIH-aUf0xYHIyt-HS9F7MZHlRIm1', {action: 'login'}).then(function (token) {
                $("input[name=g-recaptcha-response]").val(token);
            });
        });
    }


</script>

