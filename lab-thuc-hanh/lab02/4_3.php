<?php
// Khai báo biến
$a = 1;
$b = 2;
$x = "2"; // chuỗi

// Cộng số
echo "a + b = " . ($a + $b) . "<br>";
echo "a + x = " . ($a + $x) . "<br>"; // PHP sẽ ép kiểu

// Ghép chuỗi
$chuoi = "Xin " . "chào";
echo $chuoi . "<br>";

// So sánh == và ===
if ($a == $x) {
    echo "a == x : Đúng (so sánh giá trị)<br>";
} else {
    echo "a == x : Sai<br>";
}

if ($a === $x) {
    echo "a === x : Đúng (so sánh cả kiểu dữ liệu)<br>";
} else {
    echo "a === x : Sai (khác kiểu dữ liệu)<br>";
}
?>
