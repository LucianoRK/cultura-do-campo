<?php

class SESSION {

    static function gen_session($id_usuario) {
        $o_usuario = new Usuario();
        $usuario = $o_usuario->select_usuario_from_id($id_usuario);
        if (!empty($usuario)) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome_usuario'] = $usuario['nome'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            $_SESSION['id_tipo_usuario'] = $usuario['fk_tipo_usuario'];
            $_SESSION['email_usuario'] = $usuario['email'];

            /**
             * Filiado/Cooperativa/Associação
             */
            if ($usuario['fk_tipo_usuario'] == 3) {
                $o_filiado = new Filiado();
                $a_filiado = $o_filiado->select_filiado_usuario($id_usuario);
                $_SESSION['id_filiado'] = $a_filiado['id_filiado'];
                $_SESSION['nome_fantasia'] = $a_filiado['nome_fantasia'];
                $_SESSION['id_endereco'] = $o_filiado->get_id_endereco_filiado($a_filiado['id_filiado']);
            }
            /**
             * Técnico
             */
            if ($usuario['fk_tipo_usuario'] == 5) {
                $o_tecnico = new Tecnico();
                $a_tecnico = $o_tecnico->select_tecnico_from_id_usuario($id_usuario);
                $_SESSION['id_tecnico'] = $a_tecnico['id_tecnico'];
            }
            /**
             * Agricultor/Propriedade Rural
             */
            if ($usuario['fk_tipo_usuario'] == 6) {
//                $o_trabalhador = new TrabalhadorRural();
//                $o_propriedade = new PropriedadeRural();
//                $a_trabalhador = $o_trabalhador->select_trabalhador_usuario($id_usuario);
//                $a_propriedade = $o_propriedade->select_propriedades_usuario_light($id_usuario);
//                $_SESSION['propriedades_rurais'] = $a_propriedade;
//                $_SESSION['id_agricultor'] = $a_trabalhador['id_agricultor'];
            }

            return true;
        } else {
            return false;
        }
    }

    static function get_id_usuario() {
        if (isset($_SESSION['id_usuario']) && is_numeric($_SESSION['id_usuario'])) {
            return STRINGS::limpar($_SESSION['id_usuario']);
        } else {
            return false;
        }
    }

    static function get_nome_usuario() {
        if (isset($_SESSION['nome_usuario'])) {
            return STRINGS::proper_case($_SESSION['nome_usuario']);
        } else {
            return false;
        }
    }

    static function get_id_filiado() {
        if (isset($_SESSION['id_filiado']) && is_numeric($_SESSION['id_filiado'])) {
            return STRINGS::limpar($_SESSION['id_filiado']);
        } else {
            return false;
        }
    }

    static function get_email_usuario() {
        if (isset($_SESSION['email_usuario'])) {
            return $_SESSION['email_usuario'];
        } else {
            return false;
        }
    }

    static function get_id_tipo_usuario() {
        if (isset($_SESSION['id_tipo_usuario'])) {
            return $_SESSION['id_tipo_usuario'];
        } else {
            return false;
        }
    }

    static function get_tipo_usuario() {
        if (isset($_SESSION['tipo_usuario'])) {
            return $_SESSION['tipo_usuario'];
        } else {
            return false;
        }
    }

    static function get_permissoes() {
        if (isset($_SESSION['permissoes'])) {
            return explode(',', $_SESSION['permissoes']);
        } else {
            return false;
        }
    }

    static function get_meus_tecnicos() {
        $o_coordenador = new Coordenador();
        return $o_coordenador->select_ids_tecnicos_coordenador();
    }

    static function get_gravatar() {
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim(self::get_email_usuario()))) . "?s=256";
        return $grav_url;
    }

    /**
     * Só funciona com usuários que possuem endereço (obviamente)
     * Somente filiados e proprietários.
     */
    static function get_meu_id_endereco() {
        if (isset($_SESSION['id_endereco'])) {
            return $_SESSION['id_endereco'];
        } else {
            return false;
        }
    }

}
