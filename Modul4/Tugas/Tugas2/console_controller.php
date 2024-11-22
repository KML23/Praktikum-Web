<?php
require_once 'connect.php';

// Fungsi untuk mengambil semua produk
function getAllProducts() {
    global $conn;
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $products]);
    } else {
        echo json_encode(["status" => "error", "message" => "No products found."]);
    }
}

// Fungsi untuk mengambil produk berdasarkan ID
function getProductById($id) {
    global $conn;
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode(["status" => "success", "data" => $product]);
    } else {
        echo json_encode(["status" => "error", "message" => "Product not found."]);
    }
}

// Fungsi untuk membuat produk baru
function createProduct() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['name'], $data['description'], $data['price'], $data['image_url'], $data['release_date'])) {
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $image_url = $data['image_url'];
        $release_date = $data['release_date'];

        $sql = "INSERT INTO product (name, description, price, image_url, release_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $name, $description, $price, $image_url, $release_date);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Product created successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
    }
}

// Fungsi untuk memperbarui produk
function updateProduct($id) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['name'], $data['description'], $data['price'], $data['image_url'], $data['release_date'])) {
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $image_url = $data['image_url'];
        $release_date = $data['release_date'];

        $sql = "UPDATE product SET name = ?, description = ?, price = ?, image_url = ?, release_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissi", $name, $description, $price, $image_url, $release_date, $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Product updated successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
    }
}

// Fungsi untuk menghapus produk
function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Product deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting product: " . $conn->error]);
    }
}

// Memeriksa jenis request
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Get Product by ID
            getProductById($_GET['id']);
        } else {
            // Get All Products
            getAllProducts();
        }
        break;
    
    case 'POST':
        // Create Product
        createProduct();
        break;
    
    case 'PUT':
        if (isset($_GET['id'])) {
            // Update Product
            updateProduct($_GET['id']);
        } else {
            echo json_encode(["status" => "error", "message" => "Product ID is required for update."]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            // Delete Product
            deleteProduct($_GET['id']);
        } else {
            echo json_encode(["status" => "error", "message" => "Product ID is required for deletion."]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Invalid request method."]);
        break;
}
?>
