<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo 
{
    /** @var Optimizer */
    protected $optmizer;
    
    
    public function __construct($schema = "article") 
    {
        $this->optmizer = new Optimizer();
        $this->optmizer->openGraph(
                CONF_SITE_NAME,
                CONF_SITE_LANG,
                schema: ""
        )->twitterCard(
                CONF_SOCIAL_TWITTER_CREATOR,
                CONF_SOCIAL_TWITTER_PUBLISHER,
                CONF_SITE_DOMAIN
        )->publisher(
                CONF_SOCIAL_FACEBOOK_PAGE,
                CONF_SOCIAL_FACEBOOK_AUTHOR,
                CONF_SOCIAL_GOOGLE_PAGE,
                CONF_SOCIAL_GOOGLE_AUTHOR
        )->facebook(
                CONF_SOCIAL_FACEBOOK_APP
        );
    } 
    
    public function __get($name)
    {
        return $this->optmizer->data()->$name;        
    }
    
    public function render($title, $description, $url, $image, $follow = true ) 
    {
        return $this->optmizer->optimize($title, $description, $url, $image, $follow)->render();        
    }
    
    public function optmizer()
    {
        return $this->optmizer;        
    }
    
    public function data(string $title = null, string $desc = null, string $url = null, string $image = null)
    {
        return $this->optmizer->data($title, $desc, $url, $image);        
    }
}

