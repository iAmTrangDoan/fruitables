<?php
// Khởi tạo mảng rỗng
$arr = array();

// Nếu người dùng submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = trim($_POST['key']);
    $value = trim($_POST['value']);

    if ($key !== "" && $value !== "") {
        $arr[$key] = $value;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>5.1 showArray</title>
    <!-- Nhúng Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h3>Nhập Key và Value vào Mảng</h3>
    <form method="post" class="mb-3">
        <div class="mb-2">
            <label class="form-label">Key:</label>
            <input type="text" name="key" class="form-control">
        </div>
        <div class="mb-2">
            <label class="form-label">Value:</label>
            <input type="text" name="value" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm vào mảng</button>
    </form>

    <?php if (!empty($arr)) : ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arr as $k => $v) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($k); ?></td>
                        <td><?php echo htmlspecialchars($v); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
