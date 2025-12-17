<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
</head>
<body>

<h2>Tìm kiếm thông tin sản phẩm</h2>

<form action="search_result.php" method="get">
    <!-- Textbox: Nhập tên sản phẩm -->
    <label for="product_name">Tên sản phẩm:</label>
    <input type="text" id="product_name" name="product_name" required><br><br>

    <!-- Radiobutton: Cách tìm kiếm -->
    <label>Cách tìm:</label>
    <input type="radio" id="exact" name="search_type" value="exact">
    <label for="exact">Chính xác</label>
    <input type="radio" id="partial" name="search_type" value="partial" checked>
    <label for="partial">Gần đúng</label><br><br>

    <!-- Combobox: Loại sản phẩm -->
    <label for="product_type">Loại sản phẩm:</label>
    <select id="product_type" name="product_type">
        <option value="all">Tất cả</option>
        <option value="type1">Loại 1</option>
        <option value="type2">Loại 2</option>
        <option value="type3">Loại 3</option>
    </select><br><br>

    <input type="submit" value="Tìm kiếm">
    
</form>

</body>
</html>
