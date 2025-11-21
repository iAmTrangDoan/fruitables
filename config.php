<?php
session_start();
// Cấu hình database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Tài khoản mặc định của Wamp
define('DB_PASS', '');      // Password trống nếu chưa đổi
define('DB_NAME', 'organic_store');

// Kết nối database (sử dụng mysqli)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Các cấu hình khác (ví dụ: đường dẫn thư mục)
define('BASE_URL', 'http://localhost/DoAnWebsite/');
define('IMAGE_DIR', BASE_URL . 'images/');
define('PRODUCT_DIR', BASE_URL . 'product/');
?>