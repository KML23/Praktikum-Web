<?php

$height = 5; // Tinggi segitiga

for ($i = $height; $i >= 1; $i--) {
    // Spasi di awal setiap baris
    for ($j = $height; $j > $i; $j--) {
        echo " ";
    }
    // Bintang pada setiap baris
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "\n";
}
