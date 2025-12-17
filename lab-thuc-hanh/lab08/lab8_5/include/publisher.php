<?php
// Hiển thị danh sách nhà xuất bản. Bắt lỗi nếu bảng không tồn tại.
try {
    $pubs = $db->select("select * from publisher");
} catch (Exception $e) {
    // Nếu bảng publisher không tồn tại trên CSDL, hiển thị thông báo nhẹ nhàng và thoả mãn layout
    echo '<div class="text-muted small">(Nhà xuất bản chưa có dữ liệu)</div>';
    $pubs = array();
}

foreach ($pubs as $r) {
    ?>
    <div><a href="index.php?mod=book&ac=list&pub_id=<?php echo htmlspecialchars($r["pub_id"]); ?>">
            <?php echo htmlspecialchars($r["pub_name"]); ?></a>
    </div>
    <?php
}

?>