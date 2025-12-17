<?php
$url = 'https://dantri.com.vn/';
$html = file_get_contents($url);

if ($html === false) {
    echo "<div class='alert alert-danger'>Không thể tải nội dung trang $url</div>";
} else {
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($html);

    $images = $doc->getElementsByTagName('img');
    $file_pattern = '/^[a-zA-Z0-9_-]+\.(jpg|jpeg|png|gif)$/';

    $count = 0;
    $maxCount = 20;

    echo "<div class='container mt-4'>";
    echo "<h3>Danh sách hình ảnh hợp lệ từ Dân trí</h3>";
    echo "<table class='table table-bordered'>";
    echo "<thead class='table-light'><tr><th>STT</th><th>Tên file</th><th>Ảnh</th></tr></thead><tbody>";

    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        $file_name = basename($src);

        if (preg_match($file_pattern, $file_name)) {
            $count++;
            echo "<tr>";
            echo "<td>$count</td>";
            echo "<td>$file_name</td>";
            echo "<td><img src='$src' alt='$file_name' style='max-width:150px'></td>";
            echo "</tr>";
        }
        if ($count >= $maxCount) break;
    }

    echo "</tbody></table></div>";
}
?>
