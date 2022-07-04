<?php

namespace Source\Core;

use League\Plates\Engine;

class View 
{
    private $engine;
    
    public function __construct($path = CONF_VIEW_PATH, $ext = CONF_VIEW_EXT) 
    {
        $this->engine = new Engine($path, $ext);
    }
    
    public function path($name, $path) 
    {
        $this->engine->addFolder($name, $path);
        return $this;        
    }
    
    public function render($templateName, $data)
    {
        return $this->engine->render($templateName, $data);        
    }
    
    public function engine()
    {
        return $this->engine();        
    }
}
