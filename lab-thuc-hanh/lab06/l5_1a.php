<?php
$url = 'https://stu.edu.vn/';
$html = file_get_contents($url);

if ($html === false) {
    echo "<div class='alert alert-danger'>Không tải được trang: $url</div>";
} else {
    echo "<div class='alert alert-success'> Tải trang thành công: $url</div>";

    // Tạo đối tượng DOM
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($html);

    // Lấy tất cả thẻ <a>
    $links = $doc->getElementsByTagName('a');
    $count = 0;
    $maxLinks = 30;

    echo "<table class='table table-bordered mt-3'>";
    echo "<thead class='table-light'><tr><th>STT</th><th>Liên kết</th></tr></thead><tbody>";

    foreach ($links as $link) {
        if ($link instanceof DOMElement) {
            $href = $link->getAttribute('href');
            if (!empty($href)) {
                $count++;
                echo "<tr><td>$count</td><td><a href='$href' target='_blank'>$href</a></td></tr>";
            }
        }
        if ($count >= $maxLinks) break;
    }

    echo "</tbody></table>";
}
?>
