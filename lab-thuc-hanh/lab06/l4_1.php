<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = trim($_POST['username']);
    $password1  = $_POST['password1'];
    $password2  = $_POST['password2'];
    $name       = trim($_POST['name']);
    $thong_tin  = $_POST['thong_tin'];

    $err = "";

    // Kiểm tra điều kiện
    if (strlen($username) < 6) {
        $err .= "Username ít nhất phải 6 ký tự!<br>";
    }
    if ($password1 != $password2) {
        $err .= "Mật khẩu và mật khẩu nhập lại không khớp.<br>";
    }
    if (strlen($password1) < 8) {
        $err .= "Mật khẩu phải ít nhất 8 ký tự.<br>";
    }
    if (str_word_count($name) < 2) {
        $err .= "Họ tên phải chứa ít nhất 2 từ.<br>";
    }

    // Xử lý thông tin
    $thong_tin = strip_tags($thong_tin);
    $thong_tin = nl2br($thong_tin);
    $thong_tin_escaped = stripslashes(addslashes($thong_tin));

    if ($err != "") {
        echo "<div class='alert alert-danger'>$err</div>";
    } else {
        // Mã hóa mật khẩu
        $password_md5      = md5($password1);
        $password_sha1     = sha1($password_md5);
        $password_sha256   = hash('sha256', $password1);
        $password_sha3_256 = hash('sha3-256', $password1);

        echo "<div class='alert alert-success'>";
        echo "<b>Username:</b> $username <br>";
        echo "<b>Mật khẩu MD5:</b> $password_md5 <br>";
        echo "<b>Mật khẩu SHA1:</b> $password_sha1 <br>";
        echo "<b>Mật khẩu SHA256:</b> $password_sha256 <br>";
        echo "<b>Mật khẩu SHA3-256:</b> $password_sha3_256 <br>";
        echo "<hr>";
        echo "<b>Họ tên:</b> " . ucwords($name) . "<br>";
        echo "<b>Thông tin đã xử lý:</b> $thong_tin_escaped";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Đăng Ký (Bootstrap)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="mb-4">Form Đăng Ký</h2>
    <form method="post" class="card p-4 shadow">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password1" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nhập lại mật khẩu</label>
            <input type="password" name="password2" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Thông tin</label>
            <textarea name="thong_tin" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</body>
</html>
