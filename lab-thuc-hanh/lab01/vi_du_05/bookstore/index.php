<?php
include "config.php";
$obj = null;
try {
	$dsn = "mysql:host=" . HOST . "; dbname=" . DATABASE;
	//$dns ="mysql:host=" . $this->host."; dbname=". $this->database;
	$obj = new PDO($dsn, USERNAME, PASSWORD);
	$obj->query("set names 'utf8' ");
} catch (Exception $e) {
	echo $e->getMessage();
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Temporarily disable custom stylesheet to avoid display conflicts -->
	<!-- <link href="css/style.css" rel="stylesheet" type="text/css" /> -->
	<title>Trang chủ</title>
</head>

<body>
	<div class="container my-4">
		<?php
		$sql = "select * from sach";
		$stm = $obj->prepare($sql);
		$stm->execute();
		$data = $stm->fetchAll(PDO::FETCH_ASSOC);
		?>
		<table class="table table-responsive table-bordered table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên sách</th>
					<th>Hình</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $book): ?>
					<tr>
						<td><?php echo htmlspecialchars($book['masach'], ENT_QUOTES, 'UTF-8'); ?></td>
						<td><?php echo htmlspecialchars($book['tensach'], ENT_QUOTES, 'UTF-8'); ?></td>
						<td>
							<?php if (!empty($book['hinh'])): ?>
								<img src="image_data/<?php echo htmlspecialchars($book['hinh'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($book['tensach'], ENT_QUOTES, 'UTF-8'); ?>" class="img-thumbnail" style="max-width:80px; height:auto;" />
							<?php else: ?>
								<span class="text-muted">No image</span>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>