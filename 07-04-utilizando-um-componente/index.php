<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.04 - Utilizando um componente");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ instance ] https://packagist.org/packages/phpmailer/phpmailer
 */
fullStackPHPClassSession("instance", __LINE__);

use PHPMailer\PHPMailer\PHPMailer;//Trazendo componente
use PHPMailer\PHPMailer\Exception as MailException; // Utiliza classe componente

$phpMailer = new PHPMailer();
var_dump($phpMailer instanceof PHPMailer);


/*
 * [ configure ]
 */
fullStackPHPClassSession("configure", __LINE__);

try {
    $mail = new PHPMailer(true); // TRUE dis Se ocorrer qualquer exceção quero que a lance 
    
    //CONFIG
    $mail->isSMTP();
    $mail->setLanguage("br"); //linguagem personalizada. Traduz image de error
    $mail->isHTML(true); //Envia e-mail como html
    $mail->SMTPAuth = true; // utiliza servidor de smtp autenticado
    $mail->SMTPSecure = 'tls'; //Conexão tls. Porta 587
    $mail->CharSet = 'utf-8'; //base que utilizamos no sistema
    
    //AUTH - AUTENTICAÇÃO INFORMaÇÃO DISPONIBILIZADA POR SENDGRID
    $mail->Host = "smtp.sendgrid.net";
    $mail->Username = "apikey";
    $mail->Password = "";
    $mail->Port = "587";
    
    //MAIL
    $mail->setFrom("ecommercefreitas@gmail.com", "Fábio Freitas"); // Quem envia o e-mail
    $mail->Subject = "Este é meu envio via componente no FSPHP"; //Assunto
    $mail->msgHTML("<h1>Olá Mundo</h1><p>Este é meu primeiro disparo de e-mail.</p>"); // Método que converte a menssage em caractere válido para e-mail
    
    //SEND - PARA ONDE ESTÁ SENDO ENVIADO O E-MAIL
    $mail->addAddress("fabiofreitas82@yahoo.com.br", "Freitas Um Novo Humano");
    $send = $mail->send();
    
    var_dump($send);    
} catch (Exception $ex) {
    //var_dump($ex);
    echo message()->error($ex->getMessage());    
}