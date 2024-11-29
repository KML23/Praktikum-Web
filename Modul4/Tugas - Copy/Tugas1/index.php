<?php
require_once 'connect.php';

// Query untuk mengambil semua data dari tabel villa
$sql = "SELECT * FROM villa";
$all_villa = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Villa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header id="home">
    <div class="header-content">
        <h1><a href="#villa-select">Villa Rent</a></h1>
        <nav>
            <ul style="display: flex; list-style: none; padding: 0; margin: 0; align-items: center; gap: 20px;">
                <li>
                    <a href="#cart-modal" onclick="openCart()"> 
                        <img src="https://img.icons8.com/?size=100&id=85383&format=png&color=FFFFFF" 
                             alt="Cart Logo" 
                             class="cart-logo">
                    </a>
                </li>
                <li><a href="#home">Home</a></li>
                <li><a href="#footer">About</a></li>
                <li><a href="#footer">Location</a></li>
                <li><a href="#footer">Account</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">
    <section id="villa-select">
        <div class="villa-container">
            <h3 class="villa-title">Select Your Villa</h3>
            <img src="/Tugas1/Bahan/background/backgroundvilla.jpg" alt="Background" class="villa-background">
        </div>
        <ul class="villa-list">
            <?php
            // Menampilkan semua villa dari database
            if ($all_villa->num_rows > 0) {
                while($row = $all_villa->fetch_assoc()) {
                    echo '<li class="villa-item">';
                    echo '<section id="villa' . $row['id'] . '">';
                    echo '<img src="' . $row['img_url'] . '" alt="' . htmlspecialchars($row['villa_name']) . '">';
                    echo '<div class="villa-content">';
                    echo '<h2>' . htmlspecialchars($row['villa_name']) . '</h2>';
                    echo '<p class="location">Lokasi: ' . htmlspecialchars($row['location']) . '</p>';
                    echo '<div class="rent-container">';
                    echo '<p class="rent-price">Rp. ' . number_format($row['price'], 0, ',', '.') . ',-/night</p>';
                    echo '<button class="rent-now" onclick="showPaymentForm(this, \'villa' . $row['id'] . '\')">Rent Now</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</section>';
                    echo '</li>';
                }
            } else {
                echo '<p>Tidak ada villa yang tersedia.</p>';
            }
            ?>
        </ul>
    </section>
</main>

<div id="cart-modal" class="modal">
    <h3 class="modal-title">Your Cart</h3>
    <table id="cart-table" class="cart-table">
        <thead>
            <tr>
                <th>Nama Villa</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Harga Total</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data cart akan diisi di sini -->
        </tbody>
    </table>
    <button onclick="closeCart()" class="modal-button">Close</button>
</div>

<footer id="footer">
    <div class="footer-container">
        <div class="footer-left">
            <h2><a href="#home">Villa Rent</a></h2>
            <p>Enjoy a luxury staycation.</p>
        </div>
    </div>
    <p id="copyright">&copy; <span id="current-year"></span> Penyewaan Villa Nusantara. Hak cipta dilindungi undang-undang.</p>
</footer>
<script src="scripts.js"></script>
</body>
</html>
