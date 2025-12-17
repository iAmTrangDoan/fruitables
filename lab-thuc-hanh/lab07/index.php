<?php
function list_php_files($dir) {
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_file($path)) {
            if (strtolower(pathinfo($item, PATHINFO_EXTENSION)) === 'sql' && $item !== 'index.php') {
                echo '<div><a href="' . htmlspecialchars($item) . '">' . htmlspecialchars($item) . '</a></div>' . "\n";
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Index of <?php echo htmlspecialchars(basename(__DIR__)); ?></title>
  <style>body{font-family:Arial,Helvetica,sans-serif;padding:16px}a{color:#0645ad}</style>
</head>
<body>
  <h1>Index of <?php echo htmlspecialchars(basename(__DIR__)); ?></h1>
  <?php list_php_files(__DIR__); ?>
</body>
</html>
