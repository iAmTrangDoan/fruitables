<?php
$url = "https://vnexpress.net/the-thao";
$content = file_get_contents($url);

if ($content !== false) {
    // Biểu thức chính quy tìm tất cả thẻ h3 có class="title-news"
    $pattern = '/<h3\s+class=["\']title-news["\'][^>]*>(.*?)<\/h3>/is';
    preg_match_all($pattern, $content, $matches);

    if (!empty($matches[1])) {
        echo "<div class='container mt-4'>";
        echo "<h3>Danh sách tin thể thao từ VnExpress</h3>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='table-light'><tr><th>STT</th><th>Tiêu đề</th></tr></thead><tbody>";

        $i = 1;
        foreach ($matches[1] as $title) {
            // Lọc bỏ thẻ HTML bên trong để chỉ lấy text
            $cleanTitle = strip_tags($title);
            echo "<tr><td>$i</td><td>$cleanTitle</td></tr>";
            $i++;
        }

        echo "</tbody></table></div>";
    } else {
        echo "<div class='alert alert-warning'>Không tìm thấy tiêu đề bài báo.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Không đọc được trang web.</div>";
}
?>
