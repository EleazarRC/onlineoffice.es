<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre , $token) 
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    
    public function enviarConfirmacion(){
        // https://mailtrap.io/inboxes/1582461/messages
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.ionos.es';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'admin@onlineoffice.es';
        $mail->Password = 'f3e6305fe0f51e';
        /* $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'cc275b6593495e';
        $mail->Password = 'f3e6305fe0f51e'; */
        
        $mail->setFrom('admin@onlineoffice.es', 'onlineOffice.es');
        $mail->addAddress( $this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->Charset = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola, " . $this->email . "</strong> Has creado tu cuenta en
        onlineOffice.es, solo debes confirmarla presionando el siguiente enlace.</p>";
        //TODO: CAMBIAR EL ENLACE PARA SERVIDOR!
        $contenido .= "<p>Ahora ya puedes: <a href='http://localhost/index.php/confirmar-cuenta?token="
        . $this->token . "'>Confirmar Tu Cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;
        $mail->send();
    }   

    public function enviarCambioPassword(){
        // https://mailtrap.io/inboxes/1582461/messages
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.ionos.es';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'admin@onlineoffice.es';
        $mail->Password = 'f3e6305fe0f51e';
        /* $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'cc275b6593495e';
        $mail->Password = 'f3e6305fe0f51e'; */
        
        $mail->setFrom('admin@onlineoffice.es', 'onlineOffice.es');
        $mail->addAddress( $this->email, $this->nombre);
        $mail->Subject = 'Cambiar Contraseña';

        $mail->isHTML(TRUE);
        $mail->Charset = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola, " . $this->email . "</strong> Has pedido cambiar tu contraseña en
        onlineOffice.es, solo debes seguir el siguiente enlace.</p>";
        //TODO: CAMBIAR EL ENLACE PARA SERVIDOR!
        $contenido .= "<p>Pulsa en el siguiente enlace: <a href='http://localhost/index.php/cambiar-password?token="
        . $this->token . "'>Cambiar contraseñas</a></p>";
        $contenido .= "<p>Si no solicitaste este cambio, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;
        $mail->send();
    }   

    

}
