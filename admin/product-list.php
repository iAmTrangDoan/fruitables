<?php
    
    session_start();
    define('ACCESS_ALLOWED', true);
    require_once '../config/config.php';
    require_once '../models/ProductModel.php';
    $products=new ProductModel($pdo);
    $data=[];
    $error=null;
    try{
        $data=$products->getProductsForAdmin();
    }catch(PDOException $e){
        $error=$e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Fruitables Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-xicon"/>

    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
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

              <li class="nav-item active">
                <a data-bs-toggle="collapse" href="#products">
                  <i class="fas fa-tag"></i>
                  <p>Product Management</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse show" id="products">
                  <ul class="nav nav-collapse">
                    <li class="active">
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
                      <a href="order-pending.html">
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
              <a href="index.html" class="logo">
                <h3 style="color: #fff; margin-bottom: 0;">DASHBOARD</h3>
              </a>
              </div>
          </div>
          </div>

        <div class="container">
          <div class="page-inner">
            <div class="row">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                    <div class="card-title m-0">
                      <h2>PRODUCT</h2>
                    </div>

                    <div class="card-tools">
                      <a href="product-add.php" class="btn btn-primary btn-round btn-sm">
                        <span class="btn-label">
                          <i class="fa fa-plus"></i>
                        </span>
                        Add New Product
                      </a>
                    </div>
                  </div>
                  </div>
                  <div class="card-body">
                    <?php if ($error): ?>
                      <div class="alert alert-danger" role="alert">
                          Database Error: <?php echo htmlspecialchars($error); ?>
                      </div>
                    <?php endif; ?> 
                    <table class="table mt-3" align="center">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Image</th>
                          <th scope="col">Description</th>
                          <th scope="col">Price</th>
                          <th scope="col">Stock</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($data)): ?>
                          <?php foreach($data as $product): ?>
                              <tr>
                              <td><?php echo $product['id'] ?></td>
                              <td><?php echo $product['name'] ?></td>
                              <td><img src="/<?= htmlspecialchars($product['image_url']) ?>" width="200"></td>
                              <td><?php echo $product['description'] ?></td>
                              <td><?php echo $product['price'] ?></td>
                              <td><?php echo $product['stock_quantity'] ?></td>
                              
                              <td>
                                <a href="product-add.php?id=<?php echo $product['id']  ?>" class="btn btn-link btn-primary btn-lg">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <form method="post" action="product.php?action=delete" style="display:inline;">
                                  <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                  <button type="submit" class="btn btn-link btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fa fa-times"></i>
                                  </button>
                                </form>
                              </td>
                              </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="7" class="text-center">No products found.</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            
            <div class="row">
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
<body>
    
</body>
</html>