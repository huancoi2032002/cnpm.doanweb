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
    <link rel="stylesheet" href="./css/index.css" type="text/css" />
    <style>
        
    </style>
</head>

<body>
    <?php
        require 'connect.php';
        $tongsosp1trang = 6;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
            settype($page,"int");
        }else{
            $page = 1;
        }
        
        if(isset($_GET['search']) && !empty($_GET['search'])){
            $from = ($page - 1) * $tongsosp1trang;
            $tukhoa = $_GET['search'];
            $sql = "SELECT 
                        product.ID,
                        product.img_product,
                        product.name_product,
                        product.classify,
                        product.price_product,
                        product.quantity_product,
                        order_bill.status_order
                    FROM product 
                    LEFT JOIN order_detail ON order_detail.ProductID = product.ID
                    LEFT JOIN order_bill ON order_bill.OrderID = order_detail.OrderID
                    where
                    
                    ID  LIKE '%$tukhoa%' or name_product LIKE '%$tukhoa%' 
                    
                    LIMIT $from,$tongsosp1trang";
        }elseif(isset($_GET['checkbox']) && !empty($_GET['checkbox'])){
            $from = ($page - 1) * $tongsosp1trang;
            $classify = $_GET['checkbox'];
            $sql = "SELECT 
                        product.ID,
                        product.img_product,
                        product.name_product,
                        product.classify,
                        product.price_product,
                        product.quantity_product,
                        order_bill.status_order
                    FROM product 
                    LEFT JOIN order_detail ON order_detail.ProductID = product.ID
                    LEFT JOIN order_bill ON order_bill.OrderID = order_detail.OrderID
                    where
                    
                    ID  LIKE '%$classify%' or classify LIKE '%$classify%'  
                    LIMIT $from,$tongsosp1trang";
        }elseif(isset($_GET['tu']) && !empty($_GET['tu']) && isset($_GET['den']) && !empty($_GET['den'])){
            $from = ($page - 1) * $tongsosp1trang;
            $tu = $_GET['tu'];
            $den = $_GET['den'];
            $sql = "SELECT 
                        product.ID,
                        product.img_product,
                        product.name_product,
                        product.classify,
                        product.price_product,
                        product.quantity_product,
                        order_bill.status_order
                    FROM product 
                    LEFT JOIN order_detail ON order_detail.ProductID = product.ID
                    LEFT JOIN order_bill ON order_bill.OrderID = order_detail.OrderID
                    where
                    
                    
                    price_product >= '$tu' AND  price_product <=  '$den'

                    
                    LIMIT $from,$tongsosp1trang";
        }else{
            $from = ($page - 1) * $tongsosp1trang;
            $sql = "SELECT
                product.ID,
                product.img_product,
                product.name_product,
                product.classify,
                product.price_product,
                product.quantity_product,
                order_bill.status_order
            FROM
                product
            LEFT JOIN order_detail ON order_detail.ProductID = product.ID
            LEFT JOIN order_bill ON order_bill.OrderID = order_detail.OrderID
                   LIMIT $from,$tongsosp1trang";
        }
        $result = mysqli_query($conn, $sql);
        
        
    ?>
    <div class="header">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="contact">
                        <span>Hotline: <a href="tel:0349867919">0388697342</a></span>
                        <span>Email:cnpm.@gmal.com </span>
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
                                <a href="trangchu.php"><span>Trang chủ</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="lichsumuahang.php?ID=<?php echo $_SESSION['ID'] ?>"><span>Lịch sử mua hàng</span></a>
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
        <div class="container_menu">
            <div class="menu_multilevel">
                <div class="menu">
                    <i class="icon"></i>
                    <h3 class="title_menu"> Danh Mục</h3>
                    <a href="./index.html">
                        <li><i class="fa fa-home"></i>ㅤTrang chủ</li>
                    </a>
                    <a href="./sanpham.html">
                        <li><i class="fa fa-shopping-bag"></i>ㅤSản phẩm</li>
                    </a>
                    <a href="./tintuc.html">
                        <li><i class="fa fa-send"></i>ㅤTin tức</li>
                    </a>
                    <a href="./cauhoi.html">
                        <li><i class="fa fa-question-circle-o"></i>ㅤCâu hỏi</li>
                    </a>
                    <a href="#">
                        <li><i class="fa fa-phone-square"></i>ㅤLiên hệ</li>
                    </a>
                </div>

            </div>
                <div class="price_range">
                    <h3 class="title_price_range">Khoảng giá</h3>
                    <form method="get" role="form">
                        <div class="price_about">
                            <div class="input_price">
                                <input type="number" name="tu">
                            </div>
                            <div class="about">
                                -
                            </div>
                            <div class="input_price">
                                <input type="number" name="den">
                            </div>
                        </div>
                        <div class="price_range_button">
                            <button type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            <div class="classify">
                <h3 class="title_classsify">Phân loại</h3>
                <form method="get" role="form">
                    <div class="wrapper">
                        <input type="checkbox" name="checkbox" class="switch-toggle" <?php if (isset($classify) && $classify == 'Áo') echo "selected=\"selected\"";  ?> value="Áo">
                        <div class="title_switch">ㅤ<b>Áo</b></div>
                    </div>
                    <div class="wrapper">
                        <input type="checkbox" name="checkbox" class="switch-toggle" <?php if (isset($classify) && $classify == 'Quần') echo "selected=\"selected\"";  ?> value="Quần">
                        <div class="title_switch">ㅤ<b>Quần</b></div>
                        
                    </div>
                    <div class="wrapper">
                        <input type="checkbox" name="checkbox" class="switch-toggle" <?php if (isset($classify) && $classify == 'Phụ Kiện') echo "selected=\"selected\"";  ?> value="Phụ kiện">
                        <div class="title_switch">ㅤ<b>Phụ Kiện</b></div>
                    </div>
                    <div>
                        <button class="btn_classify" type="submit" id="checkbox">Lọc</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="menu_product">
            <div class="box_product">
                <div class="menu_product_primary">
                    <?php foreach ($result as $product_count) { ?>
                        <div class="product">
                            <div class="img_product">
                                <img src="<?php echo $product_count['img_product'] ?>">

                            </div>
                            <div class="name_product"><a href="#"><?php echo $product_count['name_product'] ?></a></div>
                            <div class="price_product">
                                <div class="price_initial">
                                    <span><?php echo $product_count['price_product'] ?> VDN</span>
                                </div>
                                <div class="price_discount">
                                    <span style="color:red;">
                                        <?php if($product_count['quantity_product']==0){
                                            echo "Hết hàng";
                                        }  ?>
                                    </span>
                                </div>
                            </div>
                            <div class="buttton_product">
                                <?php 
                                    if(!empty($_SESSION['ID'])){

                                ?>
                                <button class="button_add"><a href="add_to_cart.php?ID=<?php echo $product_count['ID'] ?>">Add to card</a></button>
                                <?php } ?> 
                                <button class="button_eye"><a href="chitietsanpham.php?ID=<?php echo $product_count['ID']?>"><i class="fa fa-eye"></i></a></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
        </div>
    </div>
    <div class="number_pages">
        <?php 
            $sql = "SELECT ID FROM product";
            $x = mysqli_query($conn,$sql);
            $tongsosp = mysqli_num_rows($x);
            $sotrang = ceil($tongsosp / $tongsosp1trang);
            
            for($i=1;$i<=$sotrang;$i++){
                echo '<a href="trangchu.php?page='.$i.'" class="number_page"><li>'.$i.'</li></a>' ;
            }

        ?>
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