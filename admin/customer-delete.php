<?php
session_start();
define('ACCESS_ALLOWED', true);

require_once '../config/config.php';
require_once '../models/UserModel.php';
require_once '../controllers/UserController.class.php';

$controller = new UserController($pdo);
$controller->delete();

?>