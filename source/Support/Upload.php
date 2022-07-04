<?php

namespace Source\Support;

use CoffeeCode\Uploader\Image;
use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Media;

use Source\Core\Message;

class Upload 
{
    /* @var Message */
    private $message;
    
    /* Upload construtor */
    public function __construct() 
    {
        $this->message = new Message();
    }
    
    /* @return Message */
    public function message()
    {
        return $this->message;        
    }
    
    /**
     * @param array $image
     * @param string $name
     * @param int $width
     * @return null|string
     * @throws \Exception
     */
    public function image($image, $name, $width = CONF_IMAGE_SIZE)
    {
        $upload = new Image(CONF_UPLOAD_DIR, CONF_UPLOAD_IMAGE_DIR);
        var_dump($upload::isAllowed());
        
        //Não conseguir enviar o arquivo 
        if (empty($image['type']) || !in_array($image['type'], $upload::isAllowed())){
            $this->message->error("Você não selecionou uma imagem válida");
            return null;
        }
        return $upload->upload($image, $name, $width, CONF_IMAGE_QUALITY);
    }
    
    /**
     * @param array $file
     * @param string $name
     * @return null|string
     * @throws \Exception
     */
    public function file($file, $name)
    {
        $upload = new File(CONF_UPLOAD_DIR, CONF_UPLOAD_FILE_DIR);
        
        //$UPLOAD::isALLOWED -> Método de verificação
        if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())){
            $this->message->error("Você não selecionou uma arquivo válida");
            return null;
        }
        return $upload->upload($file, $name);        
    }
    
    /**
     * @param array $media
     * @param string $name
     * @return null|string
     * @throws \Exception
     */
    public function media($media, $name)
    {
        $upload = new Media(CONF_UPLOAD_DIR, CONF_UPLOAD_MEDIA_DIR);
        
        /*
         * SE O NOSSO MEDIA TYPE NÃO EXISTIR OU SE O MEDIA TYPE NÃO ESTIVER NOS 
         * FORMATOS ACEITOS RETORNE A MESSAGE ABAIXO
         */
        if (empty($media['type']) || !in_array($media['type'], $upload::isAllowed())){
            $this->message->error("Você não selecionou uma mídia válida");
            return null;
        }
        return $upload->upload($media, $name);
        
    }
    
    /* @param string $filePath */
    public function remove($filePath)
    {
        if (file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }        
    }
}
