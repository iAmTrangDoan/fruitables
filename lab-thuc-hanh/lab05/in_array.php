<?php
if (isset($_GET['ext']) && $_GET['ext'] !== NULL) {
    $ext = trim($_GET['ext']);
    $arr = array("png", "jpg", "bmp", "gif");

    if (in_array($ext, $arr)) {
        echo "$ext: Đây là phần mở rộng của file hình";
    } else {
        echo "Không phải phần mở rộng hình hoặc chưa nhập!";
    }
}
?>

<form method="get">
    Nhập phần mở rộng file (jpg, png, bmp, gif):
    <input type="text" name="ext">
    <input type="submit" value="Kiểm tra">
</form>
