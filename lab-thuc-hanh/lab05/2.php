<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "ID nhận được: " . $id;
} else {
    echo "Không có id trong URL.";
}
?>
