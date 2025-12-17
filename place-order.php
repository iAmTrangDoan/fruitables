<?php
session_start();
require_once 'config/database.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$controller = new OrderController($pdo);
$controller->handle();
?>