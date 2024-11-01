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
$laptop1 = new Laptop("ASUS ROG", "Intel i7", 16, 8);
$desktop1 = new Desktop("Dell OptiPlex", "AMD Ryzen 5", 8, "Mini Tower");

// Menambahkan perangkat ke dalam koleksi
$deviceStore->addDevice($laptop1);
$deviceStore->addDevice($desktop1);

// Menampilkan semua perangkat dalam koleksi
$deviceStore->showAllDevices();
