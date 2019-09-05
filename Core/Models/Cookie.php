<?php


class Cookie {
    
       function __construct() {
        $this->conn = DB::get_instance();
    }

    function is_cookie_new($token) {
        $query = "
            SELECT 
                id_cookie
            FROM login_cookies
            WHERE token = '{$token}'
        ";
        $result = $this->conn->fetch($query);
        if (!empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    function get_usuario_from_cookie($token) {
        $COOKIE_LIFETIME = CONFIG::$LOGIN_COOKIE_LIFETIME;
        $query = "
            SELECT 
                fk_usuario AS id_usuario
            FROM login_cookies
            WHERE TRUE
                AND token = '{$token}'
                AND CURRENT_TIMESTAMP < (date + INTERVAL {$COOKIE_LIFETIME} SECOND) 
        ";
        return $this->conn->fetch($query);
    }

    function insert_cookie($token, $id_usuario) {
        $query = "
            INSERT INTO login_cookies
            (fk_usuario, token)
            VALUES 
            (
                '{$id_usuario}',
                '{$token}'
            )
        ";
        $this->conn->execute($query);
    }

    function delete_cookies_from_user($id_usuario) {
        $query = "
            DELETE
            FROM login_cookies
            WHERE fk_usuario = '{$id_usuario}'
        ";
        $this->conn->execute($query);
    }

    function delete_cookie($token) {
        $query = "
            DELETE FROM login_cookies
            WHERE TRUE
                AND token = '{$token}'
        ";
        $this->conn->execute($query);
    }

}
