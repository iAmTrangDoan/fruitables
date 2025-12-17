<?php
session_start();
define('ACCESS_ALLOWED', true);

require_once '../config/config.php';
require_once '../models/ProductModel.php';
require_once '../controllers/ProductController.class.php';

$action = $_GET['action'] ?? 'index';
$controller = new ProductController($pdo);

switch ($action) {
   case 'index':
        $controller->index();
        break;
    case 'form':
        $controller->form();
        break;
    case 'save':
        $controller->save();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        die('Invalid action');
}
