<?php

// ------------------- KẾT NỐI CSDL -------------------
try {
    // Tạo đối tượng PDO kết nối đến database 'bookstore' với user 'root'
    $pdh = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
    // Thiết lập bộ mã UTF-8 để hiển thị tiếng Việt đúng
    $pdh->query("set names 'utf8'");
} catch (Exception $e) {

    // Nếu kết nối thất bại thì báo lỗi và dừng chương trình
    echo $e->getMessage();
    exit;
}


// ------------------- TRUY VẤN CATEGORY -------------------
$stm = $pdh->query("select * from category"); // thực hiện truy vấn
// echo "Số dòng:" . $stm->rowCount(); // số dòng kết quả
$rows1 = $stm->fetchAll(PDO::FETCH_ASSOC); // lấy tất cả kết quả dưới dạng mảng kết hợp
// Duyệt qua từng dòng và in ra mã loại + tên loại
// foreach ($rows1 as $row) {
//     echo "<br>" . $row["cat_id"] . "-" . $row["cat_name"];
// }
?>
<!-- <hr /> -->
<?php
// ------------------- TRUY VẤN PUBLISHER -------------------
$stm = $pdh->query("select * from publisher");
// echo "Số dòng:" . $stm->rowCount();
$rows2 = $stm->fetchAll(PDO::FETCH_OBJ); // lấy kết quả dưới dạng đối tượng
// print_r($rows2); // có thể dùng để kiểm tra dữ liệu
// Duyệt qua từng dòng và in ra mã NXB + tên NXB
// foreach ($rows2 as $row) {
//     echo "<br>" . $row->pub_id . "-" . $row->pub_name;
// }
?>
<!-- <hr /> -->
<?php
// ------------------- TRUY VẤN BOOK -------------------
$sql = "select * from book where book_name like '%a%' "; // tìm sách có chữ 'a' trong tên
$stm = $pdh->query($sql);
// echo "Số dòng:" . $stm->rowCount();
$rows3 = $stm->fetchAll(PDO::FETCH_NUM); // lấy kết quả dưới dạng mảng số
// Duyệt qua từng dòng và in ra cột 0 (id) và cột 1 (tên sách)
// foreach ($rows3 as $row) {
//     echo "<br>" . $row[0] . "-" . $row[1];
// }
// ------------------- FETCH TỪNG DÒNG -------------------
// echo "<hr>";
$stm = $pdh->query("select * from category");
// echo "Số dòng:" . $stm->rowCount();
$row = $stm->fetch(PDO::FETCH_ASSOC); // lấy 1 dòng đầu tiên
// print_r($row);
$row = $stm->fetch(PDO::FETCH_ASSOC); // lấy dòng tiếp theo
// print_r($row);
// ------------------- VÒNG LẶP WHILE -------------------
// echo "<hr>";
$stm = $pdh->query("select * from publisher");
// Duyệt qua từng dòng bằng vòng lặp while
// while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
//     echo "<br>" . $row["pub_id"] . "-" . $row["pub_name"];
// }
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Loại Sách - Tối Giản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Tùy chỉnh Header Card (màu trắng/xám nhạt tối giản) */
        .card-header-simple {
            background-color: #f8f9fa !important;
            /* Màu xám nhạt */
            color: #212529 !important;
            /* Màu chữ đen */
            border-bottom: 1px solid #dee2e6;
        }

        /* Tùy chỉnh cho bảng không quá đậm */
        .table-custom thead {
            border-bottom: 2px solid #dee2e6;
        }

        .table-custom th {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container my-5">

        <h1 class="text-secondary mb-4 border-bottom pb-2">Quản Lý Loại Sách</h1>

        <?php
        // ------------------- KẾT NỐI CSDL VÀ XỬ LÝ -------------------
        try {
            $pdh = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
            $pdh->query("set names 'utf8'");
            $pdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Lỗi kết nối CSDL: " . $e->getMessage() . "</div>";
            exit;
        }

        // Xử lý Thêm Loại Sách (Giữ nguyên logic và thông báo)
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_category"])) {
            $cat_id = trim($_POST["cat_id"]);
            $cat_name = trim($_POST["cat_name"]);
            if (!empty($cat_id) && !empty($cat_name)) {
                try {
                    $sql_insert = "INSERT INTO category (cat_id, cat_name) VALUES (?, ?)";
                    $stm_insert = $pdh->prepare($sql_insert);
                    if ($stm_insert->execute([$cat_id, $cat_name])) {
                        echo "<div class='alert alert-success'>Thêm loại sách <strong>$cat_name</strong> thành công!</div>";
                    }
                } catch (Exception $e) {
                    if ($e->getCode() == '23000' && strpos($e->getMessage(), '1062') !== false) {
                        echo "<div class='alert alert-danger'>Lỗi: Mã loại <strong>$cat_id</strong> đã tồn tại.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Lỗi CSDL: " . $e->getMessage() . "</div>";
                    }
                }
            } else {
                echo "<div class='alert alert-warning'>Vui lòng nhập đầy đủ Mã loại và Tên loại.</div>";
            }
        }

        // Cấu hình Phân Trang
        $items_per_page = 10;
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $items_per_page;
        $stm_count = $pdh->query("SELECT COUNT(*) FROM category");
        $total_items = $stm_count->fetchColumn();
        $total_pages = ceil($total_items / $items_per_page);
        $sql_select = "SELECT * FROM category ORDER BY cat_id ASC LIMIT $offset, $items_per_page";
        $stm_select = $pdh->query($sql_select);
        $categories = $stm_select->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <div class="card shadow mb-4">
            <div class="card-header card-header-simple">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm Loại Sách Mới</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" class="row g-3">
                    <div class="col-md-4">
                        <label for="cat_id" class="form-label">Mã loại:</label>
                        <input type="text" class="form-control" id="cat_id" name="cat_id" required maxlength="10">
                    </div>
                    <div class="col-md-6">
                        <label for="cat_name" class="form-label">Tên loại:</label>
                        <input type="text" class="form-control" id="cat_name" name="cat_name" required maxlength="100">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" name="add_category" class="btn btn-primary w-100">
                            <i class="bi bi-check-lg me-1"></i> Thêm
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header card-header-simple">
                <h5 class="mb-0"><i class="bi bi-list-columns-reverse me-2"></i>Danh Sách Loại Sách (<?php echo $total_items; ?>)</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-custom">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">STT</th>
                                <th style="width: 20%;">Mã loại</th>
                                <th>Tên loại</th>
                                <th style="width: 15%;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = $offset + 1;
                            if (count($categories) > 0) {
                                foreach ($categories as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $stt++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row["cat_id"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["cat_name"]) . "</td>";
                                    echo "<td>
                                        <a href='#' class='btn btn-outline-secondary btn-sm me-1' title='Sửa'>
                                            <i class='bi bi-pencil-square'></i>
                                        </a>
                                        <a href='#' class='btn btn-outline-danger btn-sm' title='Xóa'>
                                            <i class='bi bi-trash3'></i>
                                        </a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>Chưa có loại sách nào được thêm.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($total_pages > 1): ?>
                    <nav aria-label="Phân trang loại sách">
                        <ul class="pagination justify-content-center">

                            <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link text-secondary" href="?page=<?php echo $current_page - 1; ?>"><i class="bi bi-chevron-left"></i></a>
                            </li>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                                <a class="page-link text-secondary" href="?page=<?php echo $current_page + 1; ?>"><i class="bi bi-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>