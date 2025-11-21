<?php
    include("config.php");
    $page=isset($_GET['page']) ? $_GET['page'] : 'home';
    switch($page){
        case 'login':
            include("login.php");
            break;
        case 'register':
            include("register.php");
            break;
        case 'admin':
            include("admin/index.php");
            break;
        case 'home':
            include("home.php");
            break;
        case 'about':
            include("about.php");
            break;
        case 'contact':
            include("contact.php");
            break;
        case 'shop':
            include("shop.php");
            break;
        case 'shop_detail':
            include("shop_detail.php");
            break;
        case 'cart':
            include("cart.php");
            break;
        case 'checkout':
            include("checkout.php");
            break;
        default:
            include("404.php");
            break;
    }
?>