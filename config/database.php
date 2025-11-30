<?php
// // Định nghĩa hằng để cho phép include
// define('ACCESS_ALLOWED', true);

// Include config để có $pdo
require_once 'config/config.php';

// Include các class khác 
require_once 'models/UserModel.php';
require_once 'controllers/RegisterController.php';
require_once 'controllers/LoginController.php';

?>