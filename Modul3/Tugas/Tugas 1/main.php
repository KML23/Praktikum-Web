<?php

require_once 'classes/DeviceStore.php';
require_once 'classes/Laptop.php';
require_once 'classes/Desktop.php';

use DeviceSystem\DeviceStore;
use DeviceSystem\Laptop;
use DeviceSystem\Desktop;

// Membuat objek DeviceStore yang berfungsi sebagai koleksi perangkat
$deviceStore = new DeviceStore();

// Membuat objek Laptop dan Desktop
$laptop1 = new Laptop("ASUS ROG Flow", "Intel Core i7 12700H", 16, "RTX 3080",8);
$desktop1 = new Desktop("ROG Strix GA35 ", "Intel Core i7 14700KF", 32, "RTX 4080","Mid Tower");

// Menambahkan perangkat ke dalam koleksi
$deviceStore->addDevice($laptop1);
$deviceStore->addDevice($desktop1);

// Menampilkan semua perangkat dalam koleksi
$deviceStore->showAllDevices();
