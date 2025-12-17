<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lab8_2 - PDO - MySQL - select - insert - parameter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="w-100 h-100">
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

    // ------------------- TRUY VẤN SELECT -------------------
    $rows = [];
    $search = '';

    // pagination defaults
    $items_per_page = 10;
    $current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $total_items = 0;
    $total_pages = 1;

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['bookSearch']) && isset($_GET['search'])) {
        $search = trim($_GET['search']);
    }

    if ($search !== '') {
        $offset = ($current_page - 1) * $items_per_page;

        // count total matching rows safely
        $countStm = $pdh->prepare("SELECT COUNT(*) FROM book WHERE book_name LIKE :kw");
        $countStm->execute(array(':kw' => "%$search%"));
        $total_items = (int)$countStm->fetchColumn();
        $total_pages = $total_items > 0 ? (int)ceil($total_items / $items_per_page) : 1;

        // select page using prepared statement and bound integers
        $sql_select = "SELECT * FROM book WHERE book_name LIKE :kw ORDER BY book_id ASC LIMIT :offset, :limit";
        $stm_select = $pdh->prepare($sql_select);
        $stm_select->bindValue(':kw', "%$search%", PDO::PARAM_STR);
        $stm_select->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stm_select->bindValue(':limit', (int)$items_per_page, PDO::PARAM_INT);
        $stm_select->execute();
        $rows = $stm_select->fetchAll(PDO::FETCH_ASSOC);
    }

    // In kết quả ra màn hình
    // echo "<pre>";
    // print_r($rows); // hiển thị mảng kết quả
    // echo "</pre>";
    // echo "<hr>";
    // // ------------------- TRUY VẤN INSERT -------------------
    // $ma = "LS1";       // mã loại sách
    // $ten = "Lịch sử"; // tên loại sách
    // $sql = "insert into category(cat_id, cat_name) values(:maloai, :tenloai)"; // câu lệnh SQL có tham số
    // $arr = array(":maloai" => $ma, ":tenloai" => $ten); // mảng ánh xạ tham số với giá trị
    // $stm = $pdh->prepare($sql); // chuẩn bị câu lệnh
    // $stm->execute($arr);        // thực thi với mảng tham số
    // $n = $stm->rowCount();      // số dòng bị ảnh hưởng (số bản ghi thêm được)
    // // In thông báo kết quả
    // echo "Đã thêm $n loại sách";

    ?>


    <main class="w-100 h-100 p-0 m-0">

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center">

            <div class="card shadow">
                <div class="card-body">

                    <form method='GET' action='lab8_2.php'>
                        <label>Tìm kiếm sách: </label>
                        <input type="text" name="search" value="<?php echo $search ?>" class="form-control" />
                        <input type='submit' class="btn" name="bookSearch" value="Tìm" />
                    </form>
                </div>

            </div>

            <!-- Các chức năng đã xử lý -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Các chức năng đã xử lý trên trang:</h5>
                    <ul>
                        <li>1. Tìm theo tên sách;</li>
                        <li>2. Phân trang (10 item / trang)</li>
                        <li>3. Hiển thị hình 40px</li>
                        <li>4. Mô tả hiển thị 20 từ đầu tiên</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow mt-4">
                <div class="card-body p-0">
                    <table class="table table-responsive table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tên sách</th>
                                <th>Mô tả</th>
                                <th>Giá tiền</th>
                                <th>Hình ảnh</th>
                                <th>Mã nhà xuất bản</th>
                                <th>Mã loại</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['book_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['book_name']) . "</td>";

                                // description snippet (first 20 words)
                                $desc = isset($row['description']) ? strip_tags($row['description']) : '';
                                $words = preg_split('/\s+/', trim($desc));
                                $snippet = '';
                                if (!empty($words)) {
                                    $snippet = implode(' ', array_slice($words, 0, 20));
                                    if (count($words) > 20) $snippet .= '...';
                                }
                                echo "<td>" . htmlspecialchars($snippet) . "</td>";
                                
                                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                echo "<td><img src='./lab8_5/image/book/" . htmlspecialchars($row['img']) . "' width='40' height='40' alt=''></td>";
                                echo "<td>" . htmlspecialchars($row['pub_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['cat_id']) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>

                    </table>

                    <?php
                    // build query suffix to preserve search in pagination links
                    $qsSuffix = '';
                    if (!empty($search)) {
                        $qsSuffix = '&search=' . urlencode($search) . '&bookSearch=1';
                    }
                    if ($total_pages > 1): ?>
                        <nav aria-label="Phân trang sách" class="p-3">
                            <ul class="pagination justify-content-center mb-0">

                                <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link text-secondary" href="?page=<?php echo max(1, $current_page - 1) . $qsSuffix; ?>"><i class="bi bi-chevron-left"></i></a>
                                </li>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i . $qsSuffix; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link text-secondary" href="?page=<?php echo min($total_pages, $current_page + 1) . $qsSuffix; ?>"><i class="bi bi-chevron-right"></i></a>
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