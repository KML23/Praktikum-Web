<?php

namespace LibrarySystem;

abstract class Item {
    protected $title;
    protected $author;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
    }

    // Abstract method untuk implementasi di class turunan
    abstract public function getInfo();
}
