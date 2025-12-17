<?php
// Khai báo hằng số PI
define('PI', 3.14);

// Hàm tính diện tích hình tròn
function dienTichHinhTron($r) {
    return PI * $r * $r;
}

// Ví dụ: bán kính 10
$r = 10;
echo "Diện tích hình tròn có bán kính $r là: " . dienTichHinhTron($r) . "<br>";

// Thử thêm một vài giá trị khác
for ($i = 1; $i <= 5; $i++) {
    echo "Bán kính $i => Diện tích: " . dienTichHinhTron($i) . "<br>";
}
?>
