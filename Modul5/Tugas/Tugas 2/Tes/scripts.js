let cart = [];
// Fungsi untuk menambahkan data ke cart
function addToCart(consoleName, startDate, endDate, totalPrice, paymentMethod) {
  const rental = {
    id: Date.now(),
    consoleName,
    startDate,
    endDate,
    totalPrice,
    paymentMethod,
  };
  cart.push(rental); // Menambahkan item ke dalam cart
  openCart(); // Tampilkan cart setelah item ditambahkan
}

// Fungsi untuk mengambil data dari formulir dan menambahkannya ke dalam cart
function handleAddToCart(consoleName) {
  const startDate = document.getElementById("start-date-ps1").value;
  const endDate = document.getElementById("end-date-ps1").value;
  const paymentMethod = document.getElementById("payment-method-ps1").value;

  if (!startDate || !endDate) {
    alert("Tanggal mulai dan selesai harus diisi!");
    return;
  }

  const dailyRate = 15000; // Tarif harian untuk konsol
  const totalPrice = calculateTotalPrice(startDate, endDate, dailyRate);

  // Panggil fungsi addToCart untuk menambahkan item ke dalam cart
  addToCart(consoleName, startDate, endDate, totalPrice, paymentMethod);
}

// Fungsi untuk menghitung total biaya sewa
function calculateTotalPrice(startDate, endDate, dailyRate) {
  const start = new Date(startDate);
  const end = new Date(endDate);
  const rentalDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
  return rentalDays * dailyRate;
}

// Fungsi untuk merender tabel cart di modal
function renderCart() {
  const cartTableBody = document
    .getElementById("cart-table")
    .getElementsByTagName("tbody")[0];
  cartTableBody.innerHTML = "";
  cart.forEach((item) => {
    const row = cartTableBody.insertRow();
    row.innerHTML = `
                    <td>${item.consoleName}</td>
                    <td>${item.startDate}</td>
                    <td>${item.endDate}</td>
                    <td>Rp. ${item.totalPrice.toLocaleString("id-ID")}</td>
                    <td>${item.paymentMethod}</td>
                    <td>
                        <button onclick="openEditModal(${
                          item.id
                        })" style="margin-right: 10px;">Edit</button>
                        <button onclick="deleteCart(${item.id})">Hapus</button>
                    </td>
                `;
  });
}

// Fungsi untuk membuka modal cart
function openCart() {
  renderCart(); // Render data cart
  document.getElementById("cart-modal").style.display = "block"; // Tampilkan modal
}

// Fungsi untuk menutup modal cart
function closeCart() {
  document.getElementById("cart-modal").style.display = "none";
}

// Fungsi untuk menghapus item dari cart
function deleteCart(id) {
  cart = cart.filter((item) => item.id !== id); // Hapus item dari cart
  renderCart(); // Perbarui tampilan cart
}

// Fungsi untuk membuka modal edit
function openEditModal(id) {
  const item = cart.find((cartItem) => cartItem.id === id);
  if (item) {
    document.getElementById("edit-console-name").value = item.consoleName;
    document.getElementById("edit-start-date").value = item.startDate;
    document.getElementById("edit-end-date").value = item.endDate;
    document.getElementById("edit-payment-method").value = item.paymentMethod;
    document.getElementById("edit-id").value = item.id;
    document.getElementById("edit-modal").style.display = "block";
  }
}

// Fungsi untuk menyimpan perubahan data edit
function saveEdit() {
  const id = parseInt(document.getElementById("edit-id").value, 10);
  const updatedItem = {
    id,
    consoleName: document.getElementById("edit-console-name").value,
    startDate: document.getElementById("edit-start-date").value,
    endDate: document.getElementById("edit-end-date").value,
    totalPrice: calculateTotalPrice(
      document.getElementById("edit-start-date").value,
      document.getElementById("edit-end-date").value,
      15000
    ),
    paymentMethod: document.getElementById("edit-payment-method").value,
  };

  cart = cart.map((item) => (item.id === id ? updatedItem : item)); // Update item di cart
  renderCart(); // Perbarui tampilan cart
  closeEditModal(); // Tutup modal edit
}

// Fungsi untuk menutup modal edit
function closeEditModal() {
  document.getElementById("edit-modal").style.display = "none";
}

// Fungsi untuk menampilkan formulir pembayaran
function showPaymentForm(button, consoleId) {
  const paymentForm = button.closest("section").querySelector(".payment-form");
  paymentForm.style.display = "block";

  const today = new Date();
  const todayString = today.toISOString().split("T")[0];

  const startDateInput = document.getElementById("start-date-" + consoleId);
  startDateInput.value = todayString;
  startDateInput.min = todayString;

  const endDateInput = document.getElementById("end-date-" + consoleId);
  endDateInput.min = todayString;
}

// Fungsi untuk memperbarui tanggal akhir pada formulir pembayaran
function updateEndDate(consoleId) {
  const startDateInput = document.getElementById("start-date-" + consoleId);
  const endDateInput = document.getElementById("end-date-" + consoleId);

  endDateInput.min = startDateInput.value;
}

// Fungsi untuk menghitung total biaya pada formulir pembayaran
function calculateTotalCost(consoleId, dailyRate) {
  const startDateInput = document.getElementById(
    "start-date-" + consoleId
  ).value;
  const endDateInput = document.getElementById("end-date-" + consoleId).value;

  if (startDateInput && endDateInput) {
    const startDate = new Date(startDateInput);
    const endDate = new Date(endDateInput);
    const diffTime = Math.abs(endDate - startDate);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    document.getElementById("rental-days-" + consoleId).textContent =
      diffDays > 0 ? diffDays : 0;
    const totalCost = diffDays > 0 ? diffDays * dailyRate : 0;

    document.querySelector(
      ".total-cost-" + consoleId
    ).textContent = `Rp. ${totalCost.toLocaleString("id-ID")},-`;
  } else {
    document.getElementById("rental-days-" + consoleId).textContent = 0;
    document.querySelector(".total-cost-" + consoleId).textContent = `Rp. 0,-`;
  }
}

// Fungsi untuk memperbarui tahun, tanggal, dan waktu di footer
function updateDateTime() {
  const now = new Date();

  const optionsDate = {
    year: "numeric",
    month: "long",
    day: "numeric",
    weekday: "long",
  };
  const dateString = now.toLocaleDateString("id-ID", optionsDate);

  const optionsTime = {
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
    hour12: false,
  };
  const timeString = now.toLocaleTimeString("id-ID", optionsTime);

  document.getElementById("current-date").textContent = dateString;
  document.getElementById("current-time").textContent = timeString;
}
updateDateTime();
setInterval(updateDateTime, 1000);

    const themeToggle = document.getElementById("theme-toggle");
    const currentTheme = localStorage.getItem("theme");

    // Mengatur tema saat halaman dimuat
    if (currentTheme) {
      document.body.classList.toggle("light-theme", currentTheme === "light");
    }

    themeToggle.addEventListener("click", () => {
      document.body.classList.toggle("light-theme");
      // Simpan tema saat ini di localStorage
      const theme = document.body.classList.contains("light-theme")
        ? "light"
        : "dark";
      localStorage.setItem("theme", theme);
      // Ubah ikon sesuai tema
      themeToggle.textContent = theme === "light" ? "☀️" : "🌙"; // Ganti ikon
    });
