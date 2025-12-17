<?php
session_start();
require 'config/database.php';
$controller = new CartController($pdo);
$controller->add();
?>


