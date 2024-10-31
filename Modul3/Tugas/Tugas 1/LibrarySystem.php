<?php

namespace LibrarySystem;

// Trait untuk menampilkan informasi
trait DisplayTrait {
    public function displayInfo() {
        echo "Judul: {$this->title}, Penulis: {$this->author}\n";
    }
}

// Abstract class dengan abstract method
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

// Class Book yang meng-extend Item
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

// Class Library sebagai koleksi dari beberapa buku
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

// Contoh penggunaan program
$library = new Library();

$book1 = new Book("Laskar Pelangi", "Andrea Hirata", "Fiksi");
$book2 = new Book("Bumi Manusia", "Pramoedya Ananta Toer", "Sejarah");

$library->addBook($book1);
$library->addBook($book2);

$library->showAllBooks();
