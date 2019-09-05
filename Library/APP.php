<?php

class APP
{

    static function start()
    {
        $request = self::get_request();
        ROUTER::include_file($request);
    }

    private static function get_request()
    {
        if (isset($_SERVER['REDIRECT_URL'])) {
            $host    = $_SERVER['HTTP_HOST'];
            $request = explode("/", $_SERVER['REDIRECT_URL']);
            if ($host == "localhost") {
                $request = $request[2] ? $request[2] : self::rota_default(true);
            } else {
                $request = $request[1] ? $request[1] : self::rota_default(true);
            }
        } else {
            $request = self::rota_default(true);
        }
        return $request;
    }
    /*
     * Verifica se a sessão do usuário é válida
     * Caso false, redireciona para o login
     */

    static function is_logged()
    {
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['nome_usuario'])) {
            if ($_SESSION['id_usuario'] > 0 && !empty($_SESSION['nome_usuario'])) {
                $o_permissao            = new Permissao();
                /**
                 * Foi colocado aqui para que seja em tempo real.
                 */
                $_SESSION['permissoes'] = $o_permissao->select_permissoes_tipo_usuario($_SESSION['id_tipo_usuario']);
                return true;
            } else {
                return self::check_for_cookie();
            }
        } else {
            return self::check_for_cookie();
        }
    }

    static function rota_default($base_only = false)
    {
        if (SESSION::get_id_tipo_usuario() == "1") {
            $request = 'sistema/github/issues';
        } else {
            $request = 'inicio';
        }

        if ($base_only) {
            return explode("/", $request)[0];
        } else {
            return $request;
        }
    }

    static function return_response($result, $message)
    {
        $response['result']  = $result;
        $response['message'] = $message;
        echo json_encode($response);
        if ($result) {
            exit;
        } else {
            throw new Exception;
        }
    }

    static function return_data($array)
    {
        $response['result'] = $array ? true : false;
        $response['dados']  = $array;
        echo json_encode($response);
        if ($response['result']) {
            exit;
        } else {
            throw new Exception;
        }
    }

    static function get_base_url()
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host == "localhost") {
            return "http://localhost/admin";
        } else {
            return "http://culturadocampo.com.br";
        }
    }

    static function get_origem_request()
    {
        if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origem = $_SERVER['HTTP_REFERER'];
        } else {
            $origem = $_SERVER['REMOTE_ADDR'];
        }
        return $origem;
    }

    private static function check_for_cookie()
    {
        if (!isset($_COOKIE["REMEMBER_ME"])) {
            return false;
        } else {
            $o_cookie = new Cookie();
            $usuario  = $o_cookie->get_usuario_from_cookie($_COOKIE["REMEMBER_ME"]);
            if (empty($usuario)) {
                $o_cookie->delete_cookie($_COOKIE["REMEMBER_ME"]);
                return false;
            } else {
                return SESSION::gen_session($usuario['id_usuario']);
            }
        }
    }

    static function gen_token($length)
    {
        $o_cookie     = new Cookie();
        $token        = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max          = strlen($codeAlphabet); // edited
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }
        $is_new = $o_cookie->is_cookie_new($token);
        if ($is_new) {
            return $token;
        } else {
            self::gen_token($length);
        }
    }

    static function has_permissao($id_permissao)
    {
        if (in_array($id_permissao, SESSION::get_permissoes())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Não funciona 100%, nao vai ficar desta forma
     */
    static function gravar_erro($arquivo, $tipo, $mensagem, $linha)
    {
        $db = DB::get_instance(true);

        $db->beginTransaction();
        $o_erro = new Erro();
        $o_erro->insert_erro($arquivo, $tipo, $mensagem, $linha);
        $db->commit();
    }

    static function check_htaccess()
    {
        $o_rota = new Rota();
        $o_rota->rebuild_htaccess();
    }

    static function is_localhost()
    {
        $host = $_SERVER['HTTP_HOST'];
        if ($host == "localhost") {
            return true;
        } else {
            return false;
        }
    }
}