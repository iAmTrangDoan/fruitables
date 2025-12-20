<?php
session_start();
define('ACCESS_ALLOWED', true);
require_once '../config/config.php';
require_once '../models/ProductModel.php';
require_once '../models/CategoryModel.php'; 

$model = new ProductModel($pdo);
$categoryModel = new CategoryModel($pdo); 
$categories = $categoryModel->getCategories();  

$id = $_GET['id'] ?? null;
$product = null;

// Nếu có id → sửa
if ($id) {
    $product = $model->getById($id);
    if (!$product) {
        die('Product not found');
    }
}

// Submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;

    // Gom dữ liệu product thành mảng
    $data = [
        'name'           => $_POST['name'],
        'description'    => $_POST['description'],
        'price'          => $_POST['price'],
        'stock_quantity' => $_POST['stock_quantity'],
        'image_url'      => $_POST['image_url'] ?? ($product['image_url'] ?? ''),  // Nếu rỗng, giữ nguyên giá trị cũ (chỉ cho update),
        'category_id'    => $_POST['category_id']
    ];

    if ($id) {
        $model->update($id, $data);
    } else {
        $model->insert($data);
    }

    header('Location: product-list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Fruitables Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-xicon" />

  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
          <a href="index.php" class="logo">
            <h3 style="color: #fff; margin-bottom: 0;">Fruitables Admin</h3>
          </a>

        </div>
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a href="index.php">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Store Management</h4>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#categories">
                <i class="fas fa-box"></i>
                <p>Category Management</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="categories">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="category-list.php">
                      <span class="sub-item">Category List</span>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#products">
                <i class="fas fa-tag"></i>
                <p>Product Management</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="products">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="product-list.php">
                      <span class="sub-item">Product List</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#orders">
                <i class="fas fa-shopping-cart"></i>
                <p>Order Management</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="orders">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="order-list.php">
                      <span class="sub-item">All Orders</span>
                    </a>
                  </li>
                  <li>
                    <a href="order-pending.php">
                      <span class="sub-item">Pending Orders</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#users">
                <i class="fas fa-users"></i>
                <p>User Management</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="users">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="customer-list.php">
                      <span class="sub-item">Customer Accounts</span>
                    </a>
                  </li>
                  <li>
                    <a href="admin-list.php">
                      <span class="sub-item">Admin Accounts</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a href="../logout.php" style="background-color: #3e4a59;">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
              <h3 style="color: #fff; margin-bottom: 0;">DASHBOARD</h3>
            </a>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">

                            <div class="card-title m-0">
                                <h2>PRODUCT</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                         <form action="product.php?action=save" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" value="<?= $product['id'] ?? 'Auto' ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                            </div>
                             <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" value="<?= htmlspecialchars($product['price'] ?? '') ?>" required>
                            </div>
                             <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="stock_quantity" value="<?= htmlspecialchars($product['stock_quantity'] ?? '') ?>" required>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image">
                                
                                <?php if (!empty($product['image_url'])): ?>
                                    <img src="../<?= $product['image_url'] ?>" 
                                        style="width:100px;margin-top:10px;">
                                    <input type="hidden" name="old_image" value="<?= $product['image_url'] ?>">
                                <?php endif; ?>
                            </div>
                             <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category_id" id="category" class="form-control" >
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= ($product['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <?= $id ? 'Update Product' : 'Add Product' ?>
                            </button>

                            <a href="product-list.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
      </footer>
    </div>

  </div>
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/kaiadmin.min.js"></script>
  <script src="assets/js/setting-demo.js"></script>
  <script src="assets/js/demo.js"></script>
  <script>
    // ... (Phần script sparkline và chart giữ nguyên) ...
  </script>
</body>

</html>