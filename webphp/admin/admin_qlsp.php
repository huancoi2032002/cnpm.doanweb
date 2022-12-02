<?php 
    require '../connect.php';
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_qlsp.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_qlsp.css" type="text/css" />
</head>
<body>
    <?php
        require '../connect.php';
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
        $ket_qua_product = mysqli_query($conn, $sql);
    ?>
    <div class="body_admin">
        <div class="menu_admin">
            <div class="account_admin">
                <div class="img_admin">
                    <img src="https://thuthuatnhanh.com/wp-content/uploads/2020/09/avatar-cho-con-gai-mau-hong-cute.jpg">
                </div>
                <div class="name_admin">
                    <p>Hữu Huân</p>
                </div>
            </div>
            <div class="menu_function">
                <div class="menu">
                    <div class="menu_item">
                        <a href="../admin/admin_home.php" class="menu_link">
                            <div class="icon"><i class="fa fa-home"></i></div>
                            <div class="title">Home</div>
                        </a>
                    </div>
                    <div class="menu_item">
                        <a href="../admin/thongke.php" class="menu_link">
                            <div class="icon"><i class="fa fa-external-link-square"></i></div>
                            <div class="title">Thống kê</div>
                        </a>
                    </div>
                    <div class="menu_item">
                        <a href="../admin/admin_qlkh.php" class="menu_link">
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <div class="title">Quản lý khách hàng</div>
                        </a>
                    </div>
                    <div class="menu_item">
                        <a href="../admin/admin_qlsp.php" class="menu_link">
                            <div class="icon"><i class="fa fa-product-hunt"></i></div>
                            <div class="title">Quản lý sản phẩm</div>
                        </a>
                    </div>
                    <div class="menu_item">
                        <a href="../admin/admin_qldh.php" class="menu_link">
                            <div class="icon"><i class="fa fa-calendar-check-o"></i></div>
                            <div class="title">Quản lý đơn hàng</div>
                        </a>
                    </div>
                    <div class="menu_item">
                        <a href="../admin/admin_qlnn.php" class="menu_link">
                            <div class="icon"><i class="fa fa-server"></i></div>
                            <div class="title">Quản lý nguồn hàng</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="list_product">
            <div class="banner_list"><p class="title_list"><a href="admin_qlsp_add.php">Thêm nguồn hàng</a> | <a href="admin_qlsp.php">Danh Sách Sản Phẩm</a></p></div>
            <div class="view_product">
                <form method="GET" role="form">
                    <div class="search">
                        <div class="input_search"><input type="text" name="search"></div>
                        <div class="btn_search"><button type="submit">Tìm kiếm</button></div>
                    </div>
                </form>
                <div class="view_product_title">
                    <div class="title_id"><p>ID</p></div>
                    <div class="title_img"><p>Hình Ảnh</p></div>
                    <div class="title_name"><p>Tên Sản Phẩm</p></div>
                    <div class="title_classify"><p>Phân Loại</p></div>
                    <div class="title_price"><p>Giá</p></div>
                    <div class="title_quantiry"><p>Số Lượng</p></div>
                    <div class="title_status"><p>Trạng Thái</p></div>
                    <div class="title_function"><p>Thao Tác</p></div>
                    

                </div>
                <?php foreach ($ket_qua_product as $product){ ?>
                    <div class="view_product_detail">
                        <div class="id_product"><p class="p_product"><?php echo $product['ID']?></p></div>
                        <div class="img_product"><img src="<?php echo $product['img_product']?>"></div>
                        <div class="name_product"><p class="p_product"><?php echo $product['name_product'] ?></p></div>
                        <div class="classify_product"><p class="p_product"><?php echo $product['classify'] ?></p></div>
                        <div class="price_product"><p class="p_product"><?php echo $product['price_product'] ?></p></div>
                        <div class="quantity_product"><p class="p_product"><?php echo $product['quantity_product'] ?></p></div>
                        <div class="quantity_product"><p class="p_product">
                            <p class="title_status" style="color: hsl(214, 100%, 59%);">
                                    <?php 
                                        switch($product['status_order']){
                                            case '0':
                                                echo "Mới đặt";
                                                break;
                                            case '1':
                                                echo"Đã Nhận";
                                                break;
                                            case '2':
                                                echo"Đã hủy";
                                                break;
                                        }
                                    ?>
                                </p>
                            </p>
                        </div>
                        <div class="function">
                            <div class="delete_product"><a href="admin_qlsp_delete.php?ID=<?php echo $product['ID'];?>"><i class="fa fa-trash-o"></i></a></div>
                            <div class="fix_product"><a href="admin_qlsp_update.php?ID=<?php echo $product['ID'];?>"><i class="fa fa-wrench"></i></a></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="number_pages">
                    <?php 
                        $sql = "SELECT ID FROM product";
                        $x = mysqli_query($conn,$sql);
                        $tongsosp = mysqli_num_rows($x);
                        $sotrang = ceil($tongsosp / $tongsosp1trang);
                        for($i=1;$i<=$sotrang;$i++){
                            echo '<a href="admin_qlsp.php?page='.$i.'" class="number_page"><li>'.$i.'</li></a>' ;
                        }
                    ?>
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>