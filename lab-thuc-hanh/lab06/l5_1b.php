<?php
$url = 'https://dantri.com.vn/';
$html = file_get_contents($url);

if ($html === false) {
    echo "<div class='alert alert-danger'>Không thể tải nội dung trang $url</div>";
} else {
    echo "<div class='alert alert-success'>✔️ Tải thành công trang $url</div>";

    // Biểu thức chính quy
    $email_pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/';
    $phone_pattern = '/(\+?[0-9]{1,4}[ -]?)?(\(?\d{3}\)?[ -]?)?\d{3}[ -]?\d{4}/';

    preg_match_all($email_pattern, $html, $emails);
    preg_match_all($phone_pattern, $html, $phones);

    // Hiển thị email
    echo "<h3>Danh sách Email</h3>";
    echo "<table class='table table-bordered'><thead><tr><th>STT</th><th>Email</th></tr></thead><tbody>";
    foreach ($emails[0] as $i => $email) {
        echo "<tr><td>".($i+1)."</td><td>$email</td></tr>";
    }
    echo "</tbody></table>";

    // Hiển thị số điện thoại (giới hạn 20)
    echo "<h3>Danh sách Số điện thoại</h3>";
    echo "<table class='table table-bordered'><thead><tr><th>STT</th><th>Số điện thoại</th></tr></thead><tbody>";
    $count = 0;
    foreach ($phones[0] as $phone) {
        $count++;
        echo "<tr><td>$count</td><td>$phone</td></tr>";
        if ($count >= 20) break;
    }
    echo "</tbody></table>";
}
?>
