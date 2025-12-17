<?php
session_start();
require_once 'config/database.php';

$controller = new CartController($pdo);
$controller->remove();