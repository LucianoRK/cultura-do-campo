<?php

try {
    if (CONFIG::$LOGIN_RECAPTCHA == FALSE || $_POST['g-recaptcha-response']) {

        if (CONFIG::$LOGIN_RECAPTCHA == TRUE) {
            $captcha_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . CONFIG::$LOGIN_CAPTCHA_SECRET . '&response=' . $_POST['g-recaptcha-response']);
            $captcha_response = json_decode($captcha_response, true);
        }

        if (CONFIG::$LOGIN_RECAPTCHA == FALSE || ($captcha_response['success'] && $captcha_response['score'] >= 0.7)) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $o_usuario = new Usuario();
            $o_cookie = new Cookie();
            $failed_attempts = $o_usuario->count_failed_login_attemps($ip);

            if ($failed_attempts['total'] >= CONFIG::$LOGIN_MAX_FAILED_ATTEMPTS) {
                $micro_seconds = (CONFIG::$LOGIN_SLEEP_BASE_DELAY * $failed_attempts['total']) * 500000;
                usleep($micro_seconds);
            }

            if (isset($_POST['usuario']) && isset($_POST['senha'])) {
                $o_usuario->set_usuario($_POST['usuario'], false);
                $o_usuario->set_senha($_POST['senha']);

                $id_usuario = $o_usuario->select_usuario_login();
                if ($id_usuario) {
                    SESSION::gen_session($id_usuario);
                    $o_cookie->delete_cookies_from_user($id_usuario);
                    if (isset($_POST['remember_me'])) {
                        $token = APP::gen_token(24);
                        $o_cookie->insert_cookie($token, $id_usuario);
                        setcookie("REMEMBER_ME", $token, time() + CONFIG::$LOGIN_COOKIE_LIFETIME, "/");
                    }
                    /**
                     * Adicionar aqui mais 1 retorno com a url base, caso a request anterior nao exista
                     */
                    APP::return_response(true, "Aguarde...");
                } else {
                    $o_usuario->insert_failed_login_attempt($o_usuario->get_senha(), $ip);
                    APP::return_response(false, "Credenciais inválidas");
                }
            } else {
                APP::return_response(false, "Credenciais inválidas");
            }
        } else {
            APP::return_response(false, "Captcha inválido");
        }
    } else {
        APP::return_response(false, "Recaptcha não carregado");
    }
} catch (Exception $exc) {
    
}


