<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public  function __construct($email, $nombre, $token)
    {
        $this->email= $email;
        $this->nombre= $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        
        $mail->Port = 2525;
        $mail->Username = '80d04d898fb21d';
        $mail->Password = 'e4ae53169969b8';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon','AppSalom.com');
        $mail->Subject = 'Confirma tu cuenta';
        
        $mail->isHTML(TRUE);
        $mail->CharSet="UTF-8";
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola". $this->nombre."</strong>Has creado tu cuenta AppSalon,
        solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p> Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token="
        .$this->token."'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;
       
        $mail->send();
        debuguear($mail);

    }

} 
?>