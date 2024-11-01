<?php

require_once 'classes/Library.php';
require_once 'classes/Book.php';

use LibrarySystem\Library;
use LibrarySystem\Book;

// Contoh penggunaan program
$library = new Library();

$book1 = new Book("Laskar Pelangi", "Andrea Hirata", "Fiksi");
$book2 = new Book("Bumi Manusia", "Pramoedya Ananta Toer", "Sejarah");

$library->addBook($book1);
$library->addBook($book2);

$library->showAllBooks();
