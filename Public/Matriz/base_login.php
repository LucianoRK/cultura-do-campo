<!DOCTYPE html>
<html lang="en">

    <!-- begin::Head -->
    <head>
        <?php if ($_SERVER['HTTP_HOST'] == "localhost") { ?>
            <base href="http://localhost/admin/">
        <?php } else { ?>
            <base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>">
        <?php } ?>

        <title>Login | <?php echo CONFIG::$PROJECT_NAME; ?></title>

        <meta charset="utf-8" />
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <link rel="shortcut icon" href="Public/Images/new_logo.png" />
        <link href="Public/Styles/style.bundle.min.css" rel="stylesheet" type="text/css">
        <link href="Public/Styles/custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
        <script src="Public/Vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="Public/Scripts/scripts.bundle.min.js" type="text/javascript"></script>
        <script src='Public/Scripts/helper.js'></script>
        <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
        <script src='https://www.google.com/recaptcha/api.js?render=6Le8m4QUAAAAAIH-aUf0xYHIyt-HS9F7MZHlRIm1'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

    </head>

    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
        <!--        <div id="topo" style="height: 10px;">
                </div>-->
        <div id="my-page" class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(Public/Images/Outros/bg-3.jpg);">
                <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                    <?php include $conteudo; ?>
                </div>
            </div>
        </div>
    </body>

    <!--<script async defer src="https://apis.google.com/js/api.js" onload="this.onload = function () {};HandleGoogleApiLibrary()" onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>-->
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
</html>


