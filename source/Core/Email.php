<?php

namespace Source\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; //Monitora as exceções

class Email {
    
    /* @var array */
    private $data;
    
    /* @var PHPMailer */
    private $mail;
    
    /* @var Message */
    private $message;

    
    public function __construct() 
    {
        $this->mail = new PHPMailer(true);
        $this->message = new Message();

        //SETUP
        $this->mail->isSMTP();
        $this->mail->setLanguage(CONF_MAIL_OPTION_LANG);
        $this->mail->isHTML(CONF_MAIL_OPTION_HTML);
        $this->mail->SMTPAuth = CONF_MAIL_OPTION_AUTH;
        $this->mail->SMTPSecure = CONF_MAIL_OPTION_SECURE;
        $this->mail->CharSet = CONF_MAIL_OPTION_CHARSET;
        
        //AUTH
        $this->mail->Host = CONF_MAIL_HOST;
        $this->mail->Port = CONF_MAIL_PORT;
        $this->mail->Username = CONF_MAIL_USER;
        $this->mail->Password = CONF_MAIL_PASS;
    }
    
    /**
     * @param string $subject
     * @param string $message
     * @param string $toEmail
     * @param string $toName
     * @return Email
     */
    public function bootstrap($subject, $message, $toEmail, $toName)
    {
        $this->data = new \stdClass();//RESETA A CLASSE PARA ENTRAR OBJ ANONIMO
        $this->data->subject = $subject;
        $this->data->message = $message;
        $this->data->toEmail = $toEmail;
        $this->data->toName = $toName;
        return $this;
    }
    
    public function attach($filePath, $fileName)
    {
        $this->data->attach[$filePath] = $fileName;
        return $this;
    }
    
    /**
     * @param $fromEmail
     * @param $fromName
     * @return boolean
     */
    public function send($fromEmail = CONF_MAIL_SENDER['address'], $fromName = CONF_MAIL_SENDER["name"]) 
    {
        if (empty($this->data)){
            $this->message->error("Erro ao enviar, favor verifique os dados");
            return false;
        }
        
        if (!is_email($this->data->toEmail)){
            $this->message->warning("O e-mail de destinatário não é válido");
        }
        
        if (!is_email($fromEmail)){
            $this->message->warning("O e-mail de remetente não é válido");
            return false;
        }
        
        //EMVIANDO E-MAIL
        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->message);
            $this->mail->addAddress($this->data->toEmail, $this->data->toName);
            $this->mail->setFrom($fromEmail, $fromName);
            
            if (!empty($this->data->attach)){//Negação data do indice attach
                foreach ($this->data->attach as $path => $name){ //Adicionando anexo
                    $this->mail->addAttachment($path, $name);                   
                }
            }
            $this->mail->send();
            return true;            
        } catch (Exception $ex) {
            $this->message->error($ex->getMessage());
            return false;            
        }
    }
    
    /* @return PHPMailer */
    public function mail()
    {
        return $this->mail;        
    }
    
    /* @return Message */
    public function message()
    {
        return $this->message;        
    }
}
