<?php

class Rota
{
    private $id_rota;
    private $url;
    private $conteudo;
    private $matriz;
    private $publico;
    private $expressao;

    function __construct()
    {
        $this->conn = DB::get_instance();
    }

    function select_rota()
    {
        $query = "
            SELECT
                id_rota,
                matriz,
                conteudo,
                publico,
                expressao
            FROM rotas 
            WHERE TRUE
                AND url = '{$this->get_url()}'
                AND ativo = '1'
        ";
        return $this->conn->fetch_all($query);
    }

    function select_rota_from_id()
    {
        $query = "
            SELECT
                id_rota,
                matriz,
                conteudo,
                publico,
                expressao,
                url,
                GROUP_CONCAT(fk_permissao) AS permissoes
            FROM rotas
            LEFT JOIN permissoes_rotas ON fk_rota = id_rota
            WHERE TRUE
                AND id_rota = '{$this->get_id_rota()}'
        ";
        return $this->conn->fetch($query);
    }

    function select_all_rotas($order = 'DESC')
    {
        $query = "
            SELECT 
                id_rota,
                url,
                matriz,
                conteudo,
                publico,
                ativo,
                expressao
            FROM rotas
            WHERE TRUE
                AND ativo = 1
            ORDER BY id_rota $order
        ";
        return $this->conn->fetch_all($query);
    }

    function get_arquivos_base()
    {
        $dir      = "Public/Matriz/";
        $filelist = scandir($dir);
        foreach ($filelist as $key => $file) {
            if (!is_file($dir.$file)) {
                unset($filelist[$key]);
            }
        }
        $filelist = array_values($filelist);
        return $this->organize_matriz_array($filelist);
    }

    function organize_matriz_array($arquivos_base)
    {
        if ($arquivos_base) {
            foreach ($arquivos_base as $key => $base) {
                $arquivo['arquivo'] = $base;

                if ($base == "base_interface.php") {
                    $arquivo['nome']     = "Template completo (Topo, menu, rodapé)";
                    $arquivo['selected'] = true;
                    $arquivos_base[$key] = $arquivo;
                } else if ($base == "base_popup.php") {
                    $arquivo['nome']     = "Página em formato popup";
                    $arquivo['selected'] = false;
                    $arquivos_base[$key] = $arquivo;
                } else {
                    unset($arquivos_base[$key]);
                }
            }
            $arquivos_base = array_values($arquivos_base);
        }
        return $arquivos_base;
    }

    function get_arquivos_conteudo()
    {
        $conteudo = array();
        $dir      = "Core/Rotas/";
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }
            if (strpos($file->getPathname(), 'include') === false) {
                $path = str_replace("\\", "/", $file->getPathname());
                $path = str_replace("Core/Rotas/", "", $path);
                array_push($conteudo, $path);
            }
        }
        return $conteudo;
    }

    function select_conteudo()
    {
        $query = "
            SELECT
                id_rota
            FROM rotas 
            WHERE TRUE
                AND conteudo = '{$this->get_conteudo()}'
                AND ativo = '1'
        ";
        return $this->conn->fetch($query);
    }

    function insert_rota()
    {
        $query = "
            INSERT INTO rotas
            (url, matriz, conteudo, publico, expressao)
            VALUES(
                '{$this->get_url()}',
                '{$this->get_matriz()}',
                '{$this->get_conteudo()}',
                '{$this->get_publico()}',
                '{$this->get_expressao()}'
            )
        ";
        $this->conn->execute($query);
        return $this->conn->last_id();
    }

    function update_rota()
    {
        $query = "
            UPDATE rotas
            SET
                url = '{$this->get_url()}',
                matriz = '{$this->get_matriz()}',
                publico = '{$this->get_publico()}',
                expressao = '{$this->get_expressao()}'
            WHERE id_rota = '{$this->get_id_rota()}'
        ";
        $this->conn->execute($query);
    }

    function create_regex($params = array())
    {
        $expressoes   = "";
        $query_string = "";
        if (!empty($params)) {
            $query_index = 1;
            foreach ($params as $param) {
                if ($param['categoria'] == "1") {

                    if ($param['expressao'] == "INT") {
                        $param['expressao'] = "(\d+)";
                    } else {
                        $param['expressao'] = "([a-zA-Z0-9\-]+)";
                    }

                    $query_string = empty($query_string) ? "?" : "{$query_string}&";
                    $expressoes   .= "\/{$param['expressao']}";
                    $query_string .= $param['nome'].'=$'.($query_index);
                    $query_index++;
                } else {
                    $expressoes .= "\/{$param['nome']}";
                }
            }
        }
        $regex_final = "^{$this->get_url()}{$expressoes}\/?$";
//        $data = PHP_EOL . "rewriteRule $regex_final ./index.php{$query_string} [NC]";
//        $fp = fopen('.htaccess', 'a');
//        fwrite($fp, $data);
        return $regex_final;
    }

    function rebuild_htaccess()
    {
        $o_parametro = new Parametro();
        $all_rotas   = $this->select_all_rotas('ASC');
        $this->clear_htaccess();
        $fp          = fopen('.htaccess', 'a');
        fwrite($fp, "rewriteEngine on".PHP_EOL);
        fwrite($fp, "rewriteEngine on".PHP_EOL);
        fwrite($fp, "rewriteCond %{SCRIPT_FILENAME} !-f".PHP_EOL);
        fwrite($fp, "rewriteCond %{SCRIPT_FILENAME} !-d".PHP_EOL);
        fwrite($fp, "Options -Indexes".PHP_EOL);
        fwrite($fp, "ErrorDocument 404 /404.php".PHP_EOL);

        foreach ($all_rotas as $rota) {
            $parametros   = $o_parametro->select_parametros($rota['id_rota']);
            $query_string = "";
            if ($parametros) {
                $query_string = array();
                foreach ($parametros as $key => $value) {
                    $index = $key + 1;
                    array_push($query_string, "{$value['nome']}=$".$index);
                }
                $query_string = implode("&", $query_string);
            }

            $regex_final = "{$rota['expressao']}";
            $data        = PHP_EOL."rewriteRule $regex_final ./index.php?{$query_string} [NC]";
            fwrite($fp, $data);
        }
        fwrite($fp, PHP_EOL."rewriteRule ^\/?$ .\/index.php [NC]".PHP_EOL);
        fclose($fp);
        $this->create_htaccess_hash_file();
    }

    function create_htaccess_hash_file()
    {
//        $hash = hash_file('md5', '.htaccess');
//        file_put_contents('hash', $hash);
    }

    function clear_htaccess()
    {
        $fp = fopen('.htaccess', 'w');
        fwrite($fp, "");
        fclose($fp);
    }

    function alterar_status_rota()
    {
        $query = "
            UPDATE rotas 
            SET ativo = !ativo 
            WHERE TRUE 
                AND id_rota = '{$this->getId()}'
        ";
        $this->conn->execute($query);
    }

    function desativar_rota()
    {
        $query = "
            UPDATE rotas
            SET ativo = 0
            WHERE TRUE
                AND id_rota = '{$this->get_id_rota()}'
        ";
        $this->conn->execute($query);
    }

    function has_permissao_acesso_rota($id_rota, $id_tipo_usuario)
    {
        $query  = "
            SELECT
                permissoes_rotas.fk_permissao
            FROM
            permissoes_tipos_usuario
            INNER JOIN permissoes_rotas ON permissoes_rotas.fk_permissao = permissoes_tipos_usuario.fk_permissao 
            WHERE TRUE
                AND fk_tipo_usuario = '{$id_tipo_usuario}'
                AND fk_rota = '{$id_rota}'
            LIMIT 1
        ";
        $result = $this->conn->fetch($query);
        return $result;
    }

    function find_rota($string)
    {
        $query  = "
            SELECT 
                * 
            FROM rotas 
            WHERE TRUE
                AND expressao LIKE '%{$string}%'
        ";
        $result = $this->conn->fetch_all($query);
        return $result;
    }

    function find_rota_or_conteudo($string)
    {
        $query  = "
            SELECT
                *
            FROM rotas
            WHERE TRUE
                AND (REPLACE(expressao,'\\\','') LIKE '%{$string}%' OR conteudo LIKE '%{$string}%')
        ";
        $result = $this->conn->fetch_all($query);
        return $result;
    }

    function get_id_rota()
    {
        return $this->id_rota;
    }

    function set_id_rota($id_rota)
    {
        $this->id_rota = $id_rota;
    }

    function get_url()
    {
        return $this->url;
    }

    function get_conteudo()
    {
        return $this->conteudo;
    }

    function get_matriz()
    {
        return $this->matriz;
    }

    function get_publico()
    {
        return $this->publico;
    }

    function set_url($url)
    {
        if ($url) {
            $this->url = STRINGS::limpar($url);
        } else {
            APP::return_response(false, "Informe a URL base");
        }
    }

    function set_conteudo($conteudo)
    {
        if ($conteudo) {
            $this->conteudo = STRINGS::limpar($conteudo);
        } else {
            APP::return_response(false, "Escolha o arquivo conteúdo PHP");
        }
    }

    function set_matriz($matriz)
    {
        $this->matriz = $matriz;
    }

    function set_publico($publico)
    {
        $this->publico = $publico;
    }

    function get_expressao()
    {
        return $this->expressao;
    }

    function set_expressao($expressao)
    {
        $this->expressao = STRINGS::limpar($expressao);
    }
}