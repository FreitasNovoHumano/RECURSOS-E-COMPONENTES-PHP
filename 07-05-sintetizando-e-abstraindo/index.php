<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.05 - Sintetizando e abstraindo");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ synthesize ]
 */
fullStackPHPClassSession("synthesize", __LINE__);

$email = (new \Source\Core\Email())->bootstrap(
    "Olá mundo, esse é meu e-mail",
    "<h1>Olá mundo!</h1><p>Essa é uma messagem via rotina de aplicação</p>",
    "losmaluco@gmail.com", //Para quem o e-mail será enviado
    "Fábio Freitas"
);

/**
 * $email->attach($filePath, $fileName);
 * $email->attach(__DIR__ . "/../../upinside/fsphp/images/cover.jpg", "FSPHP");
 */

if ($email->send()){
    echo message()->success("E-mail enviado com sucesso!");
} else {
    echo $email->message();    
}


//DISPARANDO E-MAIL
if ($email->send()){
    echo message()->success("E-mail enviado com sucesso!");
}else{
    echo $email->message();
}