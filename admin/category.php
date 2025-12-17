<?php
session_start();
define('ACCESS_ALLOWED', true);

require_once '../config/config.php';
require_once '../models/CategoryModel.php';
require_once '../controllers/CategoryController.class.php';

$action = $_GET['action'] ?? 'index';
$controller = new CategoryController($pdo);

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
?>