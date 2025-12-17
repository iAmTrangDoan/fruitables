<?php
$cat_id = getIndex("cat_id", "all");
$pub_id = getIndex("pub_id", "all");
$sql = "select * from book where 1 ";
$arr = array();
if ($cat_id != "all") {
	$sql .= " and cat_id =:cat_id ";
	$arr[":cat_id"] = $cat_id;
}

if ($pub_id != "all") {
	$sql .= " and pub_id =:pub_id ";
	$arr[":pub_id"] = $pub_id;
}

// phân trang
$perPage = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $perPage;

// đếm tổng kết quả
$countSql = str_replace('select *', 'select count(*) as c', $sql);
$count = $book->select($countSql, $arr);
$total = isset($count[0]['c']) ? (int)$count[0]['c'] : 0;
$totalPages = $total > 0 ? ceil($total / $perPage) : 1;

// thêm order và limit (gắn trực tiếp các số nguyên an toàn)
$sql .= " order by book_id asc limit " . (int)$offset . ", " . (int)$perPage;

$list = $book->select($sql, $arr);
echo "Có " . $book->getRowCount() . " kết quả (trang $page/$totalPages)";
foreach ($list as $r) {
	?>
	<div class="book">
		<?php echo htmlspecialchars($r["book_name"]); ?>
	</div>
	<?php
}

?>