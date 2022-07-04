<?php

namespace Source\Support;

use CoffeeCode\Cropper\Cropper;

class Thumb 
{
    /* @var Cropper */
    private $cropper;
    
    /* @var string */
    private $uploads;
    
    /* Thumb constructor */
    public function __construct() 
    {
        $this->cropper = new Cropper(CONF_IMAGE_CACHE, CONF_IMAGE_QUALITY['jpg'], CONF_IMAGE_QUALITY['png']);
        $this->uploads = CONF_UPLOAD_DIR;
    }
    
    /**
     * @param string $image
     * @param int $width
     * @param int|null $height
     * @return string
     */
    public function make($image, $width, $height = null)
    {
        return $this->cropper->make("{$this->uploads}/{$image}", $width, $height);        
    }
    
    /* @param string|null $image */
    public function flush($image = null)
    {
        if ($image){
            $this->cropper->flush("{$this->uploads}/{$image}");
            return;
        }
        
        $this->cropper->flush();//Limpando a pasta
        return;        
    }
    
    /* @return Cropper */
    public function cropper()
    {
        return $this->cropper;        
    }
}
