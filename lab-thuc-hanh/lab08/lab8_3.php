<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý loại sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <?php
        // ------------------- KẾT NỐI CSDL -------------------
        try {
            $pdh = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
            $pdh->query("set names 'utf8'");
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($e->getMessage()) . '</div>';
            exit;
        }

        // Xử lý edit prefill
        $edit_row = null;
        if (isset($_GET['edit'])) {
            $e = $_GET['edit'];
            $stm = $pdh->prepare("select * from category where cat_id = :id");
            $stm->execute(array(":id" => $e));
            $edit_row = $stm->fetch(PDO::FETCH_ASSOC);
        }

        // Insert (with duplicate handling)
        if (isset($_POST["sm"])) {
            $sql = "insert into category(cat_id, cat_name) values(:cat_id, :cat_name)";
            $arr = array(":cat_id" => $_POST["cat_id"], ":cat_name" => $_POST["cat_name"]);
            $stm = $pdh->prepare($sql);
            try {
                $stm->execute($arr);
                $n = $stm->rowCount();
                if ($n > 0) echo '<div class="alert alert-success">Đã thêm ' . $n . ' loại</div>';
                else echo '<div class="alert alert-warning">Lỗi thêm</div>';
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo '<div class="alert alert-danger">Mã loại đã tồn tại. Vui lòng nhập mã khác.</div>';
                } else {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($e->getMessage()) . '</div>';
                }
            }
        }

        // Update
        if (isset($_POST['update'])) {
            $sql = "update category set cat_name = :cat_name where cat_id = :cat_id";
            $arr = array(":cat_id" => $_POST['cat_id'], ":cat_name" => $_POST['cat_name']);
            $stm = $pdh->prepare($sql);
            $stm->execute($arr);
            $n = $stm->rowCount();
            if ($n > 0) echo '<div class="alert alert-success">Đã cập nhật ' . $n . ' loại</div>';
            else echo '<div class="alert alert-warning">Lỗi cập nhật hoặc không thay đổi</div>';
            if (isset($_POST['cat_id'])) {
                $stm = $pdh->prepare("select * from category where cat_id = :id");
                $stm->execute(array(":id" => $_POST['cat_id']));
                $edit_row = $stm->fetch(PDO::FETCH_ASSOC);
            }
        }

        // Delete (chặn nếu id nằm trong blacklist)
        $blacklist = array('gk', 'test');
        if (isset($_GET['del'])) {
            $del = $_GET['del'];
            if (in_array($del, $blacklist, true)) {
                echo '<div class="alert alert-warning">Không được phép xóa Mã loại trong blacklist.</div>';
            } else {
                $stm = $pdh->prepare("delete from category where cat_id = :id");
                $stm->execute(array(":id" => $del));
                $n = $stm->rowCount();
                if ($n > 0) echo '<div class="alert alert-success">Đã xóa ' . $n . ' bản ghi</div>';
                else echo '<div class="alert alert-warning">Lỗi xóa</div>';
            }
        }

        // Lấy danh sách loại sách với phân trang
        $perPage = 10;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $perPage;

        // Tổng số bản ghi
        $cstm = $pdh->prepare("select count(*) from category");
        $cstm->execute();
        $total = (int) $cstm->fetchColumn();
        $totalPages = $total > 0 ? ceil($total / $perPage) : 1;

        // Lấy dữ liệu cho trang hiện tại
        $stm = $pdh->prepare("select * from category order by cat_id LIMIT :limit OFFSET :offset");
        $stm->bindValue(':limit', (int)$perPage, PDO::PARAM_INT);
        $stm->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Form nhập dữ liệu loại sách -->
        <div class="card mb-3">
            <div class="card-body">
                <form action="lab8_3.php" method="post" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Mã loại</label>
                        <input type="text" name="cat_id" class="form-control" value="<?php echo isset($edit_row) ? htmlspecialchars($edit_row['cat_id']) : ''; ?>" <?php echo isset($edit_row) ? 'readonly' : ''; ?> required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tên loại</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo isset($edit_row) ? htmlspecialchars($edit_row['cat_name']) : ''; ?>" required />
                    </div>
                    <div class="col-md-2 align-self-end">
                        <?php if (isset($edit_row)): ?>
                            <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
                            <a href="lab8_3.php" class="btn btn-secondary">Hủy</a>
                        <?php else: ?>
                            <button type="submit" name="sm" class="btn btn-success">Thêm</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Các chức năng đã xử lý -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Các chức năng đã xử lý trên trang:</h5>
                <ul>
                    <li>CRUD - Thêm, Hiển thị, Sửa, Xóa bảng category (loại sách)</li>
                    <li>Phân trang (10 item / trang)</li>
                    <li>Chặn xóa Mã loại trong blacklist</li>
                    <li>Khóa cột Mã loại không cho edit</li>
                </ul>
            </div>
        </div>

        <!-- Hiển thị danh sách loại sách -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px">STT</th>
                        <th>Mã loại</th>
                        <th>Tên loại</th>
                        <th style="width:160px">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($rows)) {
                        $i = 1;
                        foreach ($rows as $r) {
                            echo '<tr>';
                            echo '<td>' . $i++ . '</td>';
                            echo '<td>' . htmlspecialchars($r['cat_id']) . '</td>';
                            echo '<td>' . htmlspecialchars($r['cat_name']) . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-sm btn-primary me-1" href="lab8_3.php?edit=' . urlencode($r['cat_id']) . '">Sửa</a>';
                            echo '<a class="btn btn-sm btn-danger" href="lab8_3.php?del=' . urlencode($r['cat_id']) . '" onclick="return confirm(\'Bạn có chắc muốn xóa?\')">Xóa</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($total > $perPage): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <li class="page-item <?php echo $p == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="lab8_3.php?page=<?php echo $p; ?>"><?php echo $p; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>