<?php
    // Ngăn truy cập trực tiếp vào file
    if (!defined('ACCESS_ALLOWED')) {
        die('Direct access not allowed');
    } 

    $host='localhost';
    $dbname='organic_store';
    $username='root';
    $password='';

    try {
        // Tạo kết nối PDO
        $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4",$username,$password);
        // Thiết lập chế độ lỗi
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->query("set names 'utf8'");
    }catch(PDOException $e){
        die("Lỗi kết nối DB: " . $e->getMessage());


    }
?>
