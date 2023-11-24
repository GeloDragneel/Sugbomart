<?php
    session_start();
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $menu = $uriSegments[1];


    $count = 0;
    require("connection/db.php");

    $UserID = 0;
    if(isset($_SESSION['UserID'])){
        $UserID = $_SESSION['UserID'];
    }
    $TotalWishList = 0;
    $TotalCart = 0;
    $TotalPrice = 0;
    $query = "SELECT COALESCE(SUM(Quantity),0) AS Qty, COALESCE(SUM(TotalPrice),0) AS TotalPrice FROM cart WHERE Status = 0 AND UserID = $UserID";   
    if ($result = $mysqli->query($query)) {
        while($row = $result->fetch_array()){
            $TotalCart = $row['Qty'];
            $TotalPrice = $row['TotalPrice'];
        }
    }
    $query2 = "SELECT COALESCE(COUNT(Quantity),0) AS Qty FROM wishlist WHERE Status = 0 AND UserID = $UserID";   
    if ($result2 = $mysqli->query($query2)) {
        while($row2 = $result2->fetch_array()){
            $TotalWishList = $row2['Qty'];
        }
    }

    $UserTypeTitle = 'Shopper';
    if(isset($_SESSION['UserType'])){
        switch($_SESSION['UserType']){
            case 0:
                $UserTypeTitle = 'Admin';
            break;
            case 1:
                $UserTypeTitle = 'Shopper';
            break;
            case 2:
                $UserTypeTitle = 'Vendor';
            break;
        }
    }

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sugbo Mart | <?=$UserTypeTitle?></title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/iziToast.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/datatables.css">
    <link rel="stylesheet" type="text/css" href="css/dt-global_style.css">
</script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="index"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span><?=$TotalWishList?></span></a></li>
                <li><a href="shoping-cart"><i class="fa fa-shopping-bag"></i> <span><?=$TotalCart?></span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>₱<?=$TotalPrice?></span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="login-register"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="<?php if($menu == 'index'){echo 'active';} ?>"><a href="index">Home</a></li>
                <li class="<?php if($menu == 'store'){echo 'active';} ?>"><a href="store">Shop</a></li>
                <li class="<?php if($menu == 'my-account'){echo 'active';} ?>"><a href="my-account">My Account</a></li>
                <li class="<?php if($menu == 'my-orders'){echo 'active';} ?>"><a href="my-orders">My Order</a></li>
                <li class="<?php if($menu == 'login-register'){echo 'active';} ?>"><a href="login-register">Login/Register</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> geraldezjohn29@gmail.com</li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->
        <!-- Header Section Begin -->
        <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> geraldezjohn29@gmail.com</li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <?php if(isset($_SESSION['UserID'])){ ?>
                            <div class="header__top__right__language">
                                <i class="fa fa-user"></i>
                                <div><?=$_SESSION['Firstname']?></div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="my-account">My Accounts</a></li>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </div>
                            <?php } else { ?>
                            <div class="header__top__right__language">
                                <i class="fa fa-user"></i>
                                <div id="btn_Login_Register">Login / Register</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="login">Login</a></li>
                                    <li><a href="register">Register</a></li>
                                    <li><a href="forgot-password">Forgot Password</a></li>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="index"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <nav class="header__menu">
                        <ul>
                            <?php if(!isset($_SESSION['UserType'])){?>
                            <li class="<?php if($menu == 'index'){echo 'active';} ?>"><a href="index">Home</a></li>
                            <li class="<?php if($menu == 'store'){echo 'active';} ?>"><a href="store">Shop</a></li>
                            <li class="<?php if($menu == 'my-account'){echo 'active';} ?>"><a href="my-account">My Account</a></li>
                            <li class="<?php if($menu == 'my-orders'){echo 'active';} ?>"><a href="my-orders">My Order</a></li>
                            <!-- <li class="<?php if($menu == 'login-register'){echo 'active';} ?>"><a href="login-register">Login/Register</a></li> -->
                            <?php } else { ?>
                                <?php 
                                    switch($_SESSION['UserType']){
                                        case 0: ?>
                                        <li class="<?php if($menu == 'admin-dashboard'){echo 'active';} ?>"><a href="admin-dashboard">Dashboard</a></li>
                                        <li class="<?php if($menu == 'admin-shoppers'){echo 'active';} ?>"><a href="admin-shoppers">Shoppers</a></li>
                                        <li class="<?php if($menu == 'admin-vendor'){echo 'active';} ?>"><a href="admin-vendor">Vendors</a></li>
                                        <li class="<?php if($menu == 'admin-shop'){echo 'active';} ?>"><a href="admin-shop">Shops</a></li>
                                        <li class="<?php if($menu == 'admin-transaction'){echo 'active';} ?>"><a href="admin-transaction">Transaction</a></li>
                                        <?php break;
                                        case 1: ?>
                                        <li class="<?php if($menu == 'index'){echo 'active';} ?>"><a href="index">Home</a></li>
                                        <li class="<?php if($menu == 'store'){echo 'active';} ?>"><a href="store">Shop</a></li>
                                        <li class="<?php if($menu == 'my-account'){echo 'active';} ?>"><a href="my-account">My Account</a></li>
                                        <li class="<?php if($menu == 'my-orders'){echo 'active';} ?>"><a href="my-orders">My Order</a></li>
                                        <li class="<?php if($menu == 'login-register'){echo 'active';} ?>"><a href="my-account">Hi, <?=$_SESSION['Firstname']?></a></li>
                                        <?php break;
                                        case 2: ?>
                                        <li class="<?php if($menu == 'vendor-dashboard'){echo 'active';} ?>"><a href="vendor-dashboard">Dashboard</a></li>
                                        <li class="<?php if($menu == 'vendor-shop-list'){echo 'active';} ?>"><a href="vendor-shop-list">Shop List</a></li>
                                        <li class="<?php if($menu == 'vendor-product-list'){echo 'active';} ?>"><a href="vendor-product-list">Product List</a></li>
                                        <li class="<?php if($menu == 'vendor-orders'){echo 'active';} ?>"><a href="vendor-orders">Order</a></li>
                                        <li class="<?php if($menu == 'vendor-transaction'){echo 'active';} ?>"><a href="vendor-transaction">Transaction</a></li>
                                        <?php break;
                                    }    
                                ?>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <?php if(!isset($_SESSION['UserType'])){?>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span><?=$TotalWishList?></span></a></li>
                            <li><a href="shoping-cart"><i class="fa fa-shopping-bag"></i> <span><?=$TotalCart?></span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>₱<?=$TotalPrice?></span></div>
                    </div>
                </div>
                <?php } else { ?>
                <?php 
                    switch($_SESSION['UserType']){
                        case 1: ?>
                        <div class="header__cart">
                            <ul>
                                <li><a href="#"><i class="fa fa-heart"></i> <span><?=$TotalWishList?></span></a></li>
                                <li><a href="shoping-cart"><i class="fa fa-shopping-bag"></i> <span><?=$TotalCart?></span></a></li>
                            </ul>
                            <div class="header__cart__price">item: <span>₱<?=$TotalPrice?></span></div>
                        </div>
                        <?php break; ?>
                        <?php } ?>
                <?php } ?>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->