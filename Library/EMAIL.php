<?php

include 'Library/PHPMailer/PHPMailer.php';
include 'Library/PHPMailer/SMTP.php';
include 'Library/PHPMailer/Exception.php';

class EMAIL {

    static function send_mail($destino, $assunto, $corpo) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        try {
//            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = CONFIG::$MAIL_SMPT;
            $mail->SMTPAuth = true;
            $mail->Username = CONFIG::$MAIL_USERNAME;
            $mail->Password = CONFIG::$MAIL_PASSWORD;
            $mail->SMTPSecure = CONFIG::$MAIL_PROTOCOL;
            $mail->Port = CONFIG::$MAIL_PORT;
            $mail->setFrom(CONFIG::$MAIL_USERNAME, CONFIG::$PROJECT_NAME);
            $mail->addAddress($destino);
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $corpo;
            $mail->send();
            return true;
        } catch (Exception $e) {
//            echo $mail->ErrorInfo;
            return false;
        }
    }

    private static function get_logo() {
        return "<img src='http://culturadocampo.com.br/Public/Images/Logo/horizontal_logo.png' style='width: auto; height: 48px;'><br><br>";
    }

    static function body_cadastro_usuario($nome, $usuario, $senha, $id_tipo_usuario) {
        $o_usuario = new Usuario();
        $tipo = $o_usuario->get_tipo_usuario($id_tipo_usuario);
        $body = self::get_logo();
        $body .= "<strong>{$nome}</strong>, seja bem vindo à plataforma " . CONFIG::$PROJECT_NAME . "!<br><br>";
        $body .= "Suas credenciais de acesso como <u>{$tipo}</u> são:<br><br>";
        $body .= "<strong>Usuário: </strong> {$usuario}<br>";
        $body .= "<strong>Senha: </strong> $senha<br><br>";
        $body .= "Caso deseje, você pode alterar esta senha através das configurações de perfil do seu usuário.<br>Se houver qualquer problema ou dúvida com relação à plataforma, entre em contato com o nosso suporte.<br><br>";
        $body .= self::get_assinatura();
        return $body;
    }

    private static function get_assinatura() {
        return "<strong style='color: green;'>" . strtoupper(CONFIG::$PROJECT_NAME) . "</strong>";
    }

}
