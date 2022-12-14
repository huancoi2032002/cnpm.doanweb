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
                                <li><a href="register.php">????ng k??</a></li>
                                <li><a href="login.php">????ng nh???p</a></li>
                            <?php }else
                                if($_SESSION["NAME_ACCOUNT"]) {
                            ?>
                                <li><a href="info_user.php">Welcome <?php echo $_SESSION["NAME_ACCOUNT"]; ?>!</a><a href="logout.php" tite="Logout">???Logout.</a><li>
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
                                <a href="trangchu.php"><span>Trang ch???</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="lichsumuahang.php?ID=<?php echo $_SESSION['ID'] ?>"><span>L???ch s??? mua h??ng</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./tintuc.html"><span>Tin t???c</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="./cauhoi.html"><span>C??u h???i</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header_search">
                    <form id="search-form">
                        <input id="search-text" type="text" name="search" placeholder="T??m ki???m s???n ph???m..." />
                        <button type="submit" id="search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
                <div class="header-right">
                    <div class="cartgroup">
                        <div class="mini-cart">
                            <a class="img_hover_cart" href="view_cart.php" title="gi??? h??ng">
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
                <h5 class="modal-title">Gi??? H??ng</h5>
                <span class="close" onclick="closeShoppingCart()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="cart-row">
                    <span class="cart-item cart-header cart-column">S???n Ph???m</span>
                    <span class="cart-price cart-header cart-column">Gi??</span>
                    <span class="cart-quantity cart-header cart-column">S??? L?????ng</span>
                </div>
                <div class="cart-items"></div>
                <div class="cart-total">
                    <strong class="cart-total-title">T???ng C???ng:</strong>
                    <span class="cart-total-price"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary order">
                    Thanh To??n
                </button>
            </div>
        </div>
    </div>
    <div class="center">
        <div class="container_menu">
            <div class="menu_multilevel">
                <div class="menu">
                    <i class="icon"></i>
                    <h3 class="title_menu"> Danh M???c</h3>
                    <a href="./index.html">
                        <li><i class="fa fa-home"></i>???Trang ch???</li>
                    </a>
                    <a href="./sanpham.html">
                        <li><i class="fa fa-shopping-bag"></i>???S???n ph???m</li>
                    </a>
                    <a href="./tintuc.html">
                        <li><i class="fa fa-send"></i>???Tin t???c</li>
                    </a>
                    <a href="./cauhoi.html">
                        <li><i class="fa fa-question-circle-o"></i>???C??u h???i</li>
                    </a>
                    <a href="#">
                        <li><i class="fa fa-phone-square"></i>???Li??n h???</li>
                    </a>
                </div>

            </div>
                <div class="price_range">
                    <h3 class="title_price_range">Kho???ng gi??</h3>
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
                            <button type="submit">T??m ki???m</button>
                        </div>
                    </form>
                </div>
            <div class="classify">
                <h3 class="title_classsify">Ph??n lo???i</h3>
                <form method="get" role="form">
                    <div class="wrapper">
                        <input type="checkbox" name="checkbox" class="switch-toggle" <?php if (isset($classify) && $classify == '??o') echo "selected=\"selected\"";  ?> value="??o">
                        <div class="title_switch">???<b>??o</b></div>
                    </div>
                    <div class="wrapper">
                        <input type="checkbox" name="checkbox" class="switch-toggle" <?php if (isset($classify) && $classify == 'Qu???n') echo "selected=\"selected\"";  ?> value="Qu???n">
                        <div class="title_switch">???<b>Qu???n</b></div>
                        
                    </div>
                    <div class="wrapper">
                        <input type="checkbox" name="checkbox" class="switch-toggle" <?php if (isset($classify) && $classify == 'Ph??? Ki???n') echo "selected=\"selected\"";  ?> value="Ph??? ki???n">
                        <div class="title_switch">???<b>Ph??? Ki???n</b></div>
                    </div>
                    <div>
                        <button class="btn_classify" type="submit" id="checkbox">L???c</button>
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
                                            echo "H???t h??ng";
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
                        <span>Ch??ng t??i l?? ai?</span>
                    </h4>
                    <ul>
                        <li>Cong Ty TNHH Thoi Trang CNPM</li>
                        <li>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </li>
                        <li>
                            ?????a ch???: 273 An D. V????ng, Ph?????ng 3, Qu???n 5, Th??nh ph??? H??? Ch??
                            Minh 700000
                        </li>
                        <li>??i???n tho???i: 1900 2002 - Email: support@cnpm.vn</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>