<?php

namespace LibrarySystem;

trait DisplayTrait {
    public function displayInfo() {
        echo "Judul: {$this->title}, Penulis: {$this->author}\n";
    }
}
