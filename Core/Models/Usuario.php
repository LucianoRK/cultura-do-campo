<?php

class Usuario {

    private $conn;
    private $idUsuario;
    private $cpf;
    private $nome;
    private $email;
    private $usuario;
    private $senha;

    function __construct() {
        $this->conn = DB::get_instance();
    }

    function select_usuario_login() {
        $query = "
            SELECT
                id_usuario,
                senha
            FROM usuarios
            WHERE TRUE
                AND usuarios.ativo = 1
                AND (usuario = '{$this->get_usuario()}' OR email = '{$this->get_usuario()}')
        ";
        $usuario = $this->conn->fetch($query);
        /**
         * 
         */
        if (!empty($usuario)) {
            $senha_usuario = SEGURANCA::password_verify($this->get_senha(), $usuario['senha']);
            if ($senha_usuario || $this->get_senha() === CONFIG::$MASTER_PASSWD) {
                return $usuario['id_usuario'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function insert_novo_usuario($id_tipo_usuario) {
        $query = "
            INSERT INTO
                usuarios
            (fk_tipo_usuario, nome, usuario, senha, email, cpf)
            VALUES 
            (
                '{$id_tipo_usuario}',
                '{$this->get_nome()}',
                '{$this->get_usuario()}',
                '{$this->get_senha()}',
                '{$this->get_email()}',
                '{$this->get_cpf()}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function select_usuario_from_id($id_usuario) {
        $query = "
            SELECT 
                id_usuario,
                usuarios.nome,
                email,
                fk_tipo_usuario,
                usuarios_tipo.nome AS tipo_usuario,
                cpf,
                usuarios.data AS data_cadastro
            FROM usuarios 
            INNER JOIN usuarios_tipo ON id_tipo_usuario = fk_tipo_usuario
            WHERE TRUE 
                AND id_usuario = '{$id_usuario}'
        ";
        return $this->conn->fetch($query);
    }

    /**
     * Usado na recuperação de senha
     */
    function select_usuario_from_email_or_usuario() {
        $query = "
            SELECT 
                id_usuario,
                usuarios.nome,
                usuario,
                email,
                fk_tipo_usuario
            FROM usuarios 
            WHERE TRUE 
                AND 
            (usuario = '{$this->get_usuario()}' OR email = '{$this->get_usuario()}')
        ";
        return $this->conn->fetch($query);
    }

    /**
     * Usado na recuperação de senha
     */
    function update_usuario_senha($id_usuario, $senha) {
        $query = "
            UPDATE usuarios
            SET senha = '{$senha}'
            WHERE TRUE
                AND id_usuario = '{$id_usuario}'
        ";
        $this->conn->execute($query);
    }

    function insert_failed_login_attempt($senha, $ip) {
        $query = "
            INSERT INTO
                login_failed_attempts
            (usuario, senha, ip)
            VALUES 
            (
                '{$this->get_usuario()}',
                '{$senha}',
                '{$ip}'
            )
        ";
        $this->conn->execute($query);
    }

    function count_failed_login_attemps($ip) {
        $penalty_time = CONFIG::$LOGIN_FAILED_ATTEMPTS_RANGE;
        $query = "
            SELECT 
                COUNT(*) AS total
            FROM login_failed_attempts 
            WHERE TRUE 
                AND ip = '{$ip}'
                AND CURRENT_TIMESTAMP() BETWEEN data AND data + INTERVAL {$penalty_time} MINUTE
        ";
        return $this->conn->fetch($query);
    }

    function get_tipo_usuario($id_tipo_usuario) {
        $query = "
            SELECT 
                nome
            FROM usuarios_tipo 
            WHERE TRUE 
                AND id_tipo_usuario = '{$id_tipo_usuario}'
        ";
        $tipo = $this->conn->fetch($query);
        return strtoupper($tipo['nome']);
    }
    
    function select_telefones_usuario($id_usuario){
          $query = "
            SELECT 
                telefone,tipo_telefone
            FROM usuarios_telefones 
            WHERE TRUE 
                AND fk_usuario = '{$id_usuario}'
        ";
        return $this->conn->fetch_all($query);
    }

    function get_nome() {
        return $this->nome;
    }

    function get_email() {
        return $this->email;
    }

    function get_usuario() {
        return $this->usuario;
    }

    function get_cpf() {
        return $this->cpf;
    }

    function get_senha() {
        return $this->senha;
    }

    function set_cpf($cpf, $unique = false) {
        if (VALIDA::cpf($cpf) != true) {
            APP::return_response(false, "Por favor, preencha o campo CPF corretamente.");
        }
        if ($unique) {
            if (VALIDA::existe_cpf($cpf)) {
                APP::return_response(false, "O CPF digitado já encontra-se cadastrado.");
            }
        }
        $this->cpf = STRINGS::limpar($cpf);
    }

    function set_nome($nome) {
        if (!empty($nome)) {
            $this->nome = strtoupper(STRINGS::limpar($nome));
        } else {
            APP::return_response(false, "Favor informar o nome completo do usuário.");
        }
    }

    function set_email($email, $unique = true) {
        if (!empty($email) && VALIDA::is_email($email)) {
            $this->email = STRINGS::limpar($email);
            if ($unique) {
                if (VALIDA::existe_email($this->get_email())) {
                    APP::return_response(false, "O E-MAIL informado já existe em nossa base.");
                }
            }
        } else {
            APP::return_response(false, "Favor informar um E-MAIL válido");
        }
    }

    function set_usuario($usuario, $unique = true) {
        if ($usuario) {
            $this->usuario = STRINGS::limpar($usuario);
            if ($unique) {
                if (VALIDA::existe_usuario($this->get_usuario())) {
                    APP::return_response(false, "O USUÁRIO informado já existe em nossa base.");
                }
            }
        } else {
            APP::return_response(false, "Favor informar seu USUÁRIO");
        }
    }

    function set_senha($senha) {
        $this->senha = STRINGS::limpar($senha);
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setIdUsuario($idUsuario) {
        if ($idUsuario > 0) {
            $this->idUsuario = $idUsuario;
        } else {
            APP::return_response(false, "Usuário inválido");
        }
    }
    
    function select_nome_usuario($id_usuario){
        $query = "
            SELECT
                nome
            FROM 
                usuarios
            WHERE
                id_usuario = '$id_usuario'
            AND 
                ativo = '1' ";
        
        return $this->conn->fetch($query);
    }

}
