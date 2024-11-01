<?php

namespace LibrarySystem;

require_once 'classes/Book.php';

class Library {
    private $books = [];

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function showAllBooks() {
        foreach ($this->books as $book) {
            echo $book . "\n";
        }
    }
}
