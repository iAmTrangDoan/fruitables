<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
</head>
<body>

<h2>Kết quả tìm kiếm</h2>

<?php
// Kiểm tra xem người dùng đã gửi dữ liệu không
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Lấy dữ liệu từ form
    $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';
    $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : '';
    $product_type = isset($_GET['product_type']) ? $_GET['product_type'] : 'all';

    // In ra các giá trị đã chọn
    echo "<p><strong>Tên sản phẩm:</strong> " . htmlspecialchars($product_name) . "</p>";
    
    // In ra cách tìm kiếm (gần đúng hoặc chính xác)
    echo "<p><strong>Cách tìm:</strong> ";
    if ($search_type == "exact") {
        echo "Chính xác";
    } else {
        echo "Gần đúng";
    }
    echo "</p>";
    
    // In ra loại sản phẩm (nếu không phải "Tất cả")
    if ($product_type != "all") {
        echo "<p><strong>Loại sản phẩm:</strong> " . htmlspecialchars($product_type) . "</p>";
    }
} else {
    echo "<p>Không có thông tin để hiển thị.</p>";
}
?>

</body>
</html>
