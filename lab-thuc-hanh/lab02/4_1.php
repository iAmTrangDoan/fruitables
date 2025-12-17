<?php
$a = 1;
$b = 2;
$kq = 0;

function f() {
    // Không có 'global', $kq ở đây là biến cục bộ mới
    $kq = 999; // Chỉ tồn tại trong hàm
}

f();
echo "Kết quả (xóa global): $kq\n"; // Vẫn là 0
