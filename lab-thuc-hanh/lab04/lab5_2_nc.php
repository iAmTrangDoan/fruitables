<?php
// Mảng sản phẩm ban đầu
$products = array(
    array("id" => "sp1", "name" => "Sản phẩm 1"),
    array("id" => "sp2", "name" => "Sản phẩm 2"),
    array("id" => "sp3", "name" => "Sản phẩm 3")
);

// Nếu người dùng thêm sản phẩm mới
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    if ($id !== "" && $name !== "") {
        $products[] = array("id" => $id, "name" => $name);
    }
}

// Hàm hiển thị mảng 2 chiều
function showArray($array) {
    echo "<table border=1 cellspacing=0 cellpadding=3>";
    echo "<tr><th>STT</th><th>Mã Sản Phẩm</th><th>Tên Sản Phẩm</th></tr>";
    for ($i = 0; $i < count($array); $i++) {
        echo "<tr>";
        echo "<td>" . ($i + 1) . "</td>";
        echo "<td>" . $array[$i]['id'] . "</td>";
        echo "<td>" . $array[$i]['name'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>5.2 In mảng 2 chiều</title>
</head>
<body>
    <h3>Danh sách sản phẩm</h3>
    <?php showArray($products); ?>

    <h3>Thêm sản phẩm mới</h3>
    <form method="post">
        Mã sản phẩm: <input type="text" name="id"><br><br>
        Tên sản phẩm: <input type="text" name="name"><br><br>
        <input type="submit" value="Thêm">
    </form>
</body>
</html>
