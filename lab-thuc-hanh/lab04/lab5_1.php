<?php
function showArray($arr) {
    echo "<table border=1 cellspacing=0>";
    echo "<tr><th>Index</th><th>Value</th></tr>";
    foreach ($arr as $key => $value) {
        echo "<tr align=center><td>" . $key . "</td><td>" . $value . "</td></tr>";
    }
    echo "</table>";
}

// Mảng mẫu
$arr = array(975, 642, 905, 294, 933, 947, 662, 351, 225, 608);

// Gọi hàm để hiển thị
showArray($arr);
echo "<pre>";
var_dump($arr);
echo "</pre>";
?>
