<?php
require_once 'connect.php';

// Fungsi untuk mengambil semua villa
function getAllVillas() {
    global $conn;
    $sql = "SELECT * FROM villa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $villas = [];
        while ($row = $result->fetch_assoc()) {
            $villas[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $villas]);
    } else {
        echo json_encode(["status" => "error", "message" => "No villas found."]);
    }
}

// Fungsi untuk mengambil villa berdasarkan ID
function getVillaById($id) {
    global $conn;
    $sql = "SELECT * FROM villa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $villa = $result->fetch_assoc();
        echo json_encode(["status" => "success", "data" => $villa]);
    } else {
        echo json_encode(["status" => "error", "message" => "Villa not found."]);
    }
}

// Fungsi untuk membuat villa baru
function createVilla() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['villa_name'], $data['location'], $data['price'], $data['img_url'])) {
        $villa_name = $data['villa_name'];
        $location = $data['location'];
        $price = $data['price'];
        $img_url = $data['img_url'];

        $sql = "INSERT INTO villa (villa_name, location, price, img_url) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $villa_name, $location, $price, $img_url);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Villa created successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
    }
}

// Fungsi untuk memperbarui villa
function updateVilla($id) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['villa_name'], $data['location'], $data['price'], $data['img_url'])) {
        $villa_name = $data['villa_name'];
        $location = $data['location'];
        $price = $data['price'];
        $img_url = $data['img_url'];

        $sql = "UPDATE villa SET villa_name = ?, location = ?, price = ?, img_url = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisi", $villa_name, $location, $price, $img_url, $id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Villa updated successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
    }
}

// Fungsi untuk menghapus villa
function deleteVilla($id) {
    global $conn;
    $sql = "DELETE FROM villa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Villa deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting villa: " . $conn->error]);
    }
}

// Memeriksa jenis request
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Get Villa by ID
            getVillaById($_GET['id']);
        } else {
            // Get All Villas
            getAllVillas();
        }
        break;
    
    case 'POST':
        // Create Villa
        createVilla();
        break;
    
    case 'PUT':
        if (isset($_GET['id'])) {
            // Update Villa
            updateVilla($_GET['id']);
        } else {
            echo json_encode(["status" => "error", "message" => "Villa ID is required for update."]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            // Delete Villa
            deleteVilla($_GET['id']);
        } else {
            echo json_encode(["status" => "error", "message" => "Villa ID is required for deletion."]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Invalid request method."]);
        break;
}
?>
