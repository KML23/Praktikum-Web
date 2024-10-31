<?php
function cetakBilangan($n) {
    // Perulangan dari 1 hingga n
    for ($i = 1; $i <= $n; $i++) {
        // Percabangan untuk memeriksa kondisi setiap bilangan
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024\n";
        } elseif ($i % 5 == 0) {
            echo "2024\n";
        } elseif ($i % 4 == 0) {
            echo "Pemrograman\n";
        } elseif ($i % 6 == 0) {
            echo "Website\n";
        } else {
            echo $i . "\n";
        }
    }
}

// Contoh pemanggilan fungsi dengan input n = 30
cetakBilangan(30);
?>
