<?php
header("Content-Type: text/html; charset=UTF-8");
$url = 'https://vnexpress.net';

// Dùng cURL để tải trang
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");
$html = curl_exec($ch);
curl_close($ch);

if (!$html) {
    die("Không thể tải trang <em>$url</em>");
} else {
    echo "<div class='alert alert-success'>OK. Tải thành công trang: $url</div>";
}

// Tạo đối tượng DOMDocument để phân tích HTML
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);

// Tìm các tiêu đề tin tức
$xpath = new DOMXPath($doc);
$nodes = $xpath->query('//h2[@class="uk-h5 uk-margin-small"]/a');

echo "<div class='container mt-4'>";
echo "<h3>Tiêu đề tin trang VNExpress</h3>";
echo "<table class='table table-bordered'>";
echo "<thead class='table-light'><tr><th>STT</th><th>Tiêu đề</th><th>Liên kết</th></tr></thead><tbody>";

if ($nodes->length > 0) {
    $i = 1;
    foreach ($nodes as $node) {
        $title = trim($node->nodeValue);
        $link  = $node->getAttribute('href');
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$title</td>";
        echo "<td><a href='$link' target='_blank'>$link</a></td>";
        echo "</tr>";
        $i++;
    }
} else {
    echo "<tr><td colspan='3'>Không tìm thấy tiêu đề nào. Kiểm tra lại XPath hoặc cấu trúc HTML.</td></tr>";
}

echo "</tbody></table></div>";
?>
