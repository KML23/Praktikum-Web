<?php

namespace LibrarySystem;

require_once 'classes/Item.php';
require_once 'classes/DisplayTrait.php';

class Book extends Item {
    private $genre;

    use DisplayTrait;

    public function __construct($title, $author, $genre) {
        parent::__construct($title, $author);
        $this->genre = $genre;
    }

    public function getInfo() {
        return "Judul Buku: {$this->title}, Penulis: {$this->author}, Genre: {$this->genre}";
    }

    // Magic method __toString untuk menampilkan objek sebagai string
    public function __toString() {
        return $this->getInfo();
    }
}
