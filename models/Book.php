<?php

namespace Models;

class Book extends Model
{
    protected $name;
    protected $author;
    protected $available;

    public function __construct($name = null, $author = null, $available = null)
    {
        $this->name = $name;
        $this->author = $author;
        $this->available = $available;
    }


}