<?php
// Mảng câu hỏi và đáp án đúng
$questions = [
    ["q" => "1 + 1 = ?", "options" => [1, 2, 22, 4], "answer" => 2],
    ["q" => "1 + 3 = ?", "options" => [1, 44, 3, 4], "answer" => 4],
    ["q" => "1 * 1 = ?", "options" => [1, 22, 133, 234], "answer" => 1],
    ["q" => "1 + 3 = ?", "options" => [1, 49, 3, 4], "answer" => 4],
];

$score = 0;

// Nếu người dùng submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($questions as $index => $q) {
        if (isset($_POST["q$index"])) {
            if ($_POST["q$index"] == $q["answer"]) {
                $score++;
            }
        }
    }
    echo "<h3>Kết quả: Bạn trả lời đúng $score / " . count($questions) . " câu</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>5.3 Trắc nghiệm</title>
</head>
<body>
    <h2>Bài trắc nghiệm PHP cơ bản</h2>
    <form method="post">
        <?php foreach ($questions as $index => $q): ?>
            <p><b><?php echo $q["q"]; ?></b></p>
            <?php foreach ($q["options"] as $opt): ?>
                <label>
                    <input type="radio" name="q<?php echo $index; ?>" value="<?php echo $opt; ?>">
                    <?php echo $opt; ?>
                </label><br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Nộp bài">
    </form>
</body>
</html>
