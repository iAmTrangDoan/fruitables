<?php
// Mảng lưu danh sách người đăng ký
$users = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $date     = $_POST['date'];

    $errors = [];

    // Kiểm tra username
    if (!preg_match("/^[a-zA-Z0-9._-]+$/", $username)) {
        $errors[] = "Username chỉ chứa a-z, A-Z, 0-9, ., _ và -";
    }

    // Kiểm tra password
    if (strlen($password) < 8) {
        $errors[] = "Mật khẩu phải ít nhất 8 ký tự";
    }

    // Kiểm tra email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Định dạng email sai!";
    }

    // Kiểm tra số điện thoại
    if (!preg_match("/^[0-9]+$/", $phone)) {
        $errors[] = "Số điện thoại chỉ chứa ký tự số!";
    }

    // Kiểm tra ngày sinh
    if (empty($date)) {
        $errors[] = "Chưa chọn ngày sinh!";
    }

    if (empty($errors)) {
        // Lưu vào mảng
        $users[] = [
            "username" => $username,
            "email"    => $email,
            "phone"    => $phone,
            "date"     => $date
        ];
        echo "<div class='alert alert-success'>✔️ Đăng kí thành công</div>";
    } else {
        echo "<div class='alert alert-danger'>" . implode("<br>", $errors) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab6_4.2 Đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Form Đăng Ký</h2>
    <form method="post" class="card p-4 shadow mb-4">
        <div class="mb-3">
            <label class="form-label">UserName</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày sinh</label>
            <input type="date" name="date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Điện thoại</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>

    <?php if (!empty($users)): ?>
        <h3>Danh sách người đăng ký</h3>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Ngày sinh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['username']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><?php echo htmlspecialchars($u['phone']); ?></td>
                        <td><?php echo htmlspecialchars($u['date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
