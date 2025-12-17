<?php
// Mảng câu hỏi và đáp án đúng
$questions = [
    ["q" => "Trong PHP, hàm nào dùng để kiểm tra xem một biến có phải là một mảng hay không?", 
     "options" => ["is_object()", "is_string()", "is_array()", "is_int()"], 
     "answer" => "is_array()"],
    ["q" => "Ký hiệu nào được sử dụng để bắt đầu một khối lệnh PHP?", 
     "options" => ["/*...*/", "<?php", "<script>", "<html>"], 
     "answer" => "<?php"],
    ["q" => "Biến (variable) trong PHP phải bắt đầu bằng ký hiệu nào?", 
     "options" => ["@", "#", "$", "%"], 
     "answer" => "$"],
    ["q" => "Trong PHP, toán tử so sánh \"khác biệt\" cả về giá trị và kiểu dữ liệu là gì?", 
     "options" => ["!=", "<>", "!==", "=="], 
     "answer" => "!=="],
    ["q" => "Hàm nào được dùng để mở và đọc nội dung của một tập tin trong PHP?", 
     "options" => ["file_get_contents()", "read_file()", "open_file()", "get_file_data()"], 
     "answer" => "file_get_contents()"],
    ["q" => "Câu lệnh nào dùng để kết thúc việc thực thi script hiện tại trong PHP?", 
     "options" => ["stop", "return", "break", "die"], 
     "answer" => "die"],
];

$score = 0;
$results = [];

// Nếu người dùng submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($questions as $index => $q) {
        $userAnswer = $_POST["q$index"] ?? null;
        $correct = $q["answer"];
        if ($userAnswer === $correct) {
            $score++;
            $results[$index] = "Đúng";
        } else {
            $results[$index] = "Sai (Đáp án đúng: $correct)";
        }
    }
    echo "<h3>Kết quả: Bạn trả lời đúng $score / " . count($questions) . " câu</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bài Kiểm Tra Ngẫu Nhiên</title>
</head>
<body>
    <h2>Bài trắc nghiệm PHP</h2>
    <form method="post">
        <?php foreach ($questions as $index => $q): ?>
            <p><b><?php echo ($index+1) . ". " . $q["q"]; ?></b></p>
            <?php foreach ($q["options"] as $opt): ?>
                <label>
                    <input type="radio" name="q<?php echo $index; ?>" value="<?php echo $opt; ?>">
                    <?php echo $opt; ?>
                </label><br>
            <?php endforeach; ?>
            <?php if (!empty($results)): ?>
                <p><i><?php echo $results[$index]; ?></i></p>
            <?php endif; ?>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Nộp bài">
    </form>
</body>
</html>
