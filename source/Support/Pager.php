<?php

namespace Source\Support;

use CoffeeCode\Paginator\Paginator;

class Pager extends Paginator
{
    public function __construct(mixed $link, mixed $title = null, mixed $first = null, mixed $last = null) {
        parent::__construct($link, $title, $first, $last);
    }    
}
