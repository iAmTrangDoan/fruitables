<?php
// // Định nghĩa hằng để cho phép include
// define('ACCESS_ALLOWED', true);

// Include config để có $pdo
require_once 'config/config.php';

// Include Model
require_once 'models/UserModel.php';
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';


//Include Controller
require_once 'controllers/RegisterController.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/ShopController.php';


?>