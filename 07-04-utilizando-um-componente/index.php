<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.04 - Utilizando um componente");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ instance ] https://packagist.org/packages/phpmailer/phpmailer
 */
fullStackPHPClassSession("instance", __LINE__);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

$phpMailer = new PHPMailer();
var_dump($phpMailer instanceof PHPMailer);


/*
 * [ configure ]
 */
fullStackPHPClassSession("configure", __LINE__);

try {
    $mail = new PHPMailer(true);
    
    //CONFIG
    $mail->isSMTP();
    $mail->setLanguage("br");
    $mail->isHTML(true);
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'utf-8';
    
    //AUTH
    $mail->Host = "smtp.sendgrid.net";
    $mail->Username = "apikey";
    $mail->Password = "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";
    $mail->Port = "587";
    
    //MAIL
    $mail->setFrom("ecommercefreitas@gmail.com", "Fábio Freitas");
    $mail->Subject = "Este é meu envio via componente no FSPHP";
    $mail->msgHTML("<h1>Olá Mundo</h1><p>Este é meu primeiro disparo de e-mail.</p>");
    
    //SEND
    $mail->addAddress("fabiofreitas82@yahoo.com.br", "Freitas Um Novo Humano");
    $send = $mail->send();
    
    var_dump($send);    
} catch (Exception $ex) {
    echo message()->error($ex->getMessage());    
}