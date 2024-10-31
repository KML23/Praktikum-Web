<?php

$height = 5; // Tinggi segitiga

for ($i = 1; $i <= $height; $i++) {
    // Spasi di awal setiap baris
    for ($j = $i; $j < $height; $j++) {
        echo " ";
    }
    // Bintang pada setiap baris
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "\n";
}
