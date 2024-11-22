<?php
require_once 'connect.php';

$sql = "SELECT * FROM product";
$all_product = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Console</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header id="home">
    <div class="header-content">
        <!-- <img src="https://img.icons8.com/?size=100&id=12519&format=png&color=FFFFFF" 
             alt="PlayStation Logo" 
             class="logo"> -->
        <h1><a href="#console-select">Console Rent</a></h1>
        <nav>
            <ul style="display: flex; list-style: none; padding: 0; margin: 0; align-items: center; gap: 20px;">
                <li>
                    <a href="#cart-modal" onclick="openCart()" > 
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
        <section id="console-select">
            <div class="console-container">
                <h3 class="console-title">Select Your Console</h3>
                <img src="/Tugas1/Bahan/background/backgroundps.jpg" alt="Background" class="console-background">
            </div>
            <ul class="playstation-list">
                <?php
                // Menampilkan semua produk dari database
                if ($all_product->num_rows > 0) {
                    while($row = $all_product->fetch_assoc()) {
                        echo '<li class="playstation-item">';
                        echo '<section id="playstation' . $row['id'] . '">';
                        echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                        echo '<div class="playstation-content">';
                        echo '<h2>' . $row['name'] . '</h2>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '<p class="release-date">Dirilis: ' . date('d M Y', strtotime($row['release_date'])) . '</p>';
                        echo '<div class="rent-container">';
                        echo '<p class="rent-price">Rp. ' . number_format($row['price'], 0, ',', '.') . ',-/day</p>';
                        echo '<button class="rent-now" onclick="showPaymentForm(this, \'ps' . $row['id'] . '\')">Rent Now</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</section>';
                        echo '</li>';
                    }
                } else {
                    echo '<p>Tidak ada produk yang tersedia.</p>';
                }
                ?>
            </ul>
        </section>
                </li>

              
            </ul>
        </section>
    </main>

    <div id="cart-modal" class="modal">
        <h3 class="modal-title">Your Cart</h3>
        <table id="cart-table" class="cart-table">
            <thead>
                <tr>
                    <th>Nama Konsol</th>
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

    <div id="edit-modal" class="modal edit-modal">
        <h3 class="modal-title">Edit Rental</h3>
        <form id="edit-form">
            <input type="hidden" id="edit-id">
            <div class="form-group">
                <label for="edit-console-name" class="form-label">Nama Konsol:</label>
                <input type="text" id="edit-console-name" class="form-input">
            </div>
            <div class="form-group">
                <label for="edit-start-date" class="form-label">Tanggal Mulai:</label>
                <input type="date" id="edit-start-date" class="form-input">
            </div>
            <div class="form-group">
                <label for="edit-end-date" class="form-label">Tanggal Selesai:</label>
                <input type="date" id="edit-end-date" class="form-input">
            </div>
            <button type="button" onclick="saveEdit()" class="modal-button">Save</button>
            <button type="button" onclick="closeEditModal()" class="cancel-button">Cancel</button>
        </form>
    </div>




    <footer id="footer">
        <div class="footer-container">
            <div class="footer-left">
                <h2><a href="#home">Console Rent</a></h2>
                <p>Enjoy the game for life.</p>
                <div class="social-icons">
                    <a href="#"><img src="/Tugas1/Bahan/icon/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="/Tugas1/Bahan/icon/x.png" alt="X"></a>
                    <a href="#"><img src="/Tugas1/Bahan/icon/instagram.png" alt="Instagram"></a>
                    <a href="#"><img src="/Tugas1/Bahan/icon/whatsapp.png" alt="WhatsApp"></a>
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-column">
                    <h4><a href="#home">About Us</a></h4>
                    <ul>
                        <li><a href="#About-Us">About Us</a></li>
                        <li><a href="#Help">Help</a></li>
                        <li><a href="#Contact-Us">Contact Us</a></li>
                        <li><a href="#Privacy-Policy">Privacy Policy</a></li>
                        <li><a href="#Terms&Conditions">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4><a href="#home">City</a></h4>
                    <ul>
                        <li><a href="#city-jakarta">Jakarta</a></li>
                        <li><a href="#city-bandung">Bandung</a></li>
                        <li><a href="#city-surabaya">Surabaya</a></li>
                        <li><a href="#city-malang">Malang</a></li>
                        <li><a href="#city-semarang">Semarang</a></li>
                        <li><a href="#city-yogyakarta">Yogyakarta</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4><a href="#console-select">Console Types</a></h4>
                    <ul>
                        <li><a href="#playstation1">PlayStation 1</a></li>
                        <li><a href="#playstation2">PlayStation 2</a></li>
                        <li><a href="#playstation3">PlayStation 3</a></li>
                        <li><a href="#playstation4">PlayStation 4</a></li>
                        <li><a href="#playstation5">PlayStation 5</a></li>
                        <li><a href="#xboxx">Xbox Series X</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <p id="copyright">&copy; <span id="current-year"></span> Konsol Pengguna Sekitar. Hak cipta dilindungi undang-undang | <span id="current-date"></span>,  <span id="current-time"></span></p>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>