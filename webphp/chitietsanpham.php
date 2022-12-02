<?php
    ini_set('display_errors', 'OFF');
    session_start();
    $cart = $_SESSION['cart'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/chitietsanpham.css" type="text/css" />
    <style>
        
    </style>
</head>

<body>
    <?php
        require 'connect.php';
        $ID = $_GET['ID'];
        $sql = "SELECT * FROM product where ID = $ID";
        $result = mysqli_query($conn, $sql);
    ?>
    <div class="header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="contact">
                        <span>Hotline: <a href="tel:0349867919">0344444444</a></span>
                        <span>Email:hello.@gmal.com </span>
                    </div>
                    <div class="account">
                        <ul class="account_header">
                            <?php if(empty($_SESSION['ID'])){ ?>
                                <li><a href="register.php">Đăng ký</a></li>
                                <li><a href="login.php">Đăng nhập</a></li>
                            <?php }else
                                if($_SESSION["NAME_ACCOUNT"]) {
                            ?>
                                <li><a href="info_user.php">Welcome <?php echo $_SESSION["NAME_ACCOUNT"]; ?>!</a><a href="logout.php" tite="Logout">ㅤLogout.</a><li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header_menu">
        <div class="container">
            <div class="row">
                <div class="main_menu">
                    <nav class="header-nav">
                        <ul class="item_big">
                            <li class="nav-item">
                                <a href="./index.html"><span>Trang chủ</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="purchase_history.php?ID=<?php echo $_SESSION['ID'] ?>"><span>Lịch sử mua hàng</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./tintuc.html"><span>Tin tức</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./cauhoi.html"><span>Câu hỏi</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header_search">
                    <form id="search-form">
                        <input id="search-text" type="text" name="search" placeholder="Tìm kiếm sản phẩm..." />
                        <button type="submit" id="search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="header-right">
                    <div class="cartgroup">
                        <div class="mini-cart">
                            <a class="img_hover_cart" href="view_cart.php" title="giỏ hàng">
                                <button id="cart"><i class="fa fa-shopping-bag"></i></button>
                                <span class="item_cart so-sp-gio-hang">
                                    0
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Giỏ Hàng</h5>
                <span class="close" onclick="closeShoppingCart()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="cart-row">
                    <span class="cart-item cart-header cart-column">Sản Phẩm</span>
                    <span class="cart-price cart-header cart-column">Giá</span>
                    <span class="cart-quantity cart-header cart-column">Số Lượng</span>
                </div>
                <div class="cart-items"></div>
                <div class="cart-total">
                    <strong class="cart-total-title">Tổng Cộng:</strong>
                    <span class="cart-total-price"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary order">
                    Thanh Toán
                </button>
            </div>
        </div>
    </div>
    <div class="center">
        <div class="menu_product">
            <div class="box_product">
                <div class="back_trangchu"><a href="trangchu.php">< Back</a></div>
                <div class="menu_product_primary">
                    <?php foreach ($result as $product_count): ?>
                        <div class="product">
                            <div class="box_1">
                                <div class="img_product">
                                    <img src="<?php echo $product_count['img_product'] ?>">
                                </div>
                            </div>
                            <div class="box_2">
                                <div class="name_product"><a ><?php echo $product_count['name_product'] ?></a></div>
                                <div class="price_product">
                                    
                                        <span><?php echo $product_count['price_product'] ?> VND</span>
                
                                </div>
                                <div class="describe_product">
                                    <p><?php echo $product_count['describe_product'] ?></p>
                                </div>
                                <div class="buttton_product">
                                    <button class="button_add"><a href="add_to_cart.php?ID=<?php echo $product_count['ID'] ?>">Add to card</a></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="comment">
                <div class="title_comnent">Đánh giá sản phẩm</div>
                <div class="comment_user">
                    <div class="name_user">
                        <div class="name"><h3>Nguyễn Hữu Huân</h3></div>
                        <div class="so_sao"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                    </div>
                    
                    <div class="noi_dung">Đồ rất đẹp. Mọi người nhớ mua ủng hộ nha, rất đáng túi tiền nè!</div>
                </div>
                <div class="comment_user">
                    <div class="name_user">
                        <div class="name"><h3>Trần Giang Nam</h3></div>
                        <div class="so_sao"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                    </div>
                    
                    <div class="noi_dung">Đồ rất đẹp. Mọi người nhớ mua ủng hộ nha, rất đáng túi tiền nè!</div>
                </div>
                <div class="comment_user">
                    <div class="name_user">
                        <div class="name"><h3>Trương Đức Nghĩa</h3></div>
                        <div class="so_sao"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-empty"></i></div>
                    </div>
                    
                    <div class="noi_dung">Đồ rất đẹp. Mọi người nhớ mua ủng hộ nha, rất đáng túi tiền nè!</div>
                </div>
                <div class="comment_user">
                    <div class="name_user">
                        <div class="name"><h3>Phan Mạnh Phú</h3></div>
                        <div class="so_sao"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
                    </div>
                    
                    <div class="noi_dung">Đồ rất đẹp. Mọi người nhớ mua ủng hộ nha, rất đáng túi tiền nè!</div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="right_footer">
                    <h4 class="title-name">
                        <span>Chúng tôi là ai?</span>
                    </h4>
                    <ul>
                        <li>Cong Ty TNHH Thoi Trang CNPM</li>
                        <li>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </li>
                        <li>
                            Địa chỉ: 273 An D. Vương, Phường 3, Quận 5, Thành phố Hồ Chí
                            Minh 700000
                        </li>
                        <li>Điện thoại: 1900 2002 - Email: support@cnpm.vn</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>