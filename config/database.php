<?php
// Định nghĩa hằng để cho phép include
define('ACCESS_ALLOWED', true);

// Include config để có $pdo
require_once 'config.php';

// Include Model
require_once 'models/UserModel.php';
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';
require_once 'models/OrderModel.php';
require_once  'models/CartModel.php';



//Include Controller
require_once 'controllers/RegisterController.class.php';
require_once 'controllers/LoginController.class.php';
require_once 'controllers/ShopController.class.php';
require_once 'controllers/OrderController.class.php';
require_once 'controllers/CartController.class.php';
require_once 'controllers/CheckoutController.class.php';


?>