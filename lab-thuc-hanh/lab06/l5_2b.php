<?php
header("Content-Type: text/html; charset=UTF-8");
$url = 'https://tuoitre.vn';

// Dùng file_get_contents để tải trang
$html = file_get_contents($url);

if ($html === false) {
    echo "<div class='alert alert-danger'>Không thể tải nội dung trang $url</div>";
} else {
    echo "<div class='alert alert-success'>OK Tải thành công trang: $url</div>";

    // Tạo đối tượng DOMDocument
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($html);

    // Dùng XPath để lấy các thẻ <h3> tiêu đề bài báo
    $xpath = new DOMXPath($doc);
    $nodes = $xpath->query('//h3');

    echo "<div class='container mt-4'>";
    echo "<h3>Danh sách tiêu đề tin tức Tuổi Trẻ</h3>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='table-light'><tr><th>STT</th><th>Tiêu đề</th></tr></thead><tbody>";

    $i = 1;
    foreach ($nodes as $node) {
        $title = trim($node->nodeValue);
        if (!empty($title)) {
            echo "<tr><td>$i</td><td>$title</td></tr>";
            $i++;
        }
        if ($i > 30) break; // giới hạn 30 tiêu đề
    }

    echo "</tbody></table></div>";
}
?>