<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_qlnn.css" type="text/css" />
    <title>Document</title>
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
                        order_bill.OrderID,
                        order_bill.OrderTotalPrice,
                        order_detail.OrderProductNum,
                        product.classify,
                        product.name_product,
                        order_bill.status_order,
                        product.trademark
                    FROM
                        order_bill
                    LEFT JOIN order_detail ON order_detail.OrderID = order_bill.OrderID
                    LEFT JOIN product ON product.ID = order_detail.ProductID
                    where
                        ID  LIKE '%$tukhoa%' or name_product LIKE '%$tukhoa%' or product.trademark LIKE '%$tukhoa%' and
                        order_bill.OrderID = order_detail.OrderID
                    LIMIT $from,$tongsosp1trang";
        }else{
            $from = ($page - 1) * $tongsosp1trang;
            $sql = "SELECT
                order_bill.OrderID,
                order_bill.OrderTotalPrice,
                order_detail.OrderProductNum,
                product.classify,
                product.name_product,
                order_bill.status_order,
                product.trademark
            FROM
                order_bill
            LEFT JOIN order_detail ON order_detail.OrderID = order_bill.OrderID
            LEFT JOIN product ON product.ID = order_detail.ProductID
            WHERE
                order_bill.OrderID = order_detail.OrderID
            LIMIT $from,$tongsosp1trang";
        }
        $ket_qua_product = mysqli_query($conn, $sql);
    ?>
    <div class="body_admin">
    <div class="menu_admin">
            <div class="account_admin">
                <div class="img_admin">
                    <img
                        src="https://thuthuatnhanh.com/wp-content/uploads/2020/09/avatar-cho-con-gai-mau-hong-cute.jpg">
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
            <div class="banner_list">
                <p class="title_list"><a href="admin_qlnn_add.php">Danh Sách Nguồn Hàng</a></p>
            </div>
            <form method="GET" role="form">
                    <div class="search">
                        <div class="input_search"><input type="text" name="search"></div>
                        <div class="btn_search"><button type="submit">Tìm kiếm</button></div>
                    </div>
            </form>
            <div class="view_product">
                <div class="view_product_title">
                    <div class="title_id">
                        <p>ID</p>
                    </div>
                    <div class="title_name">
                        <p>Tên Sản Phẩm</p>
                    </div>
                    <div class="title_classify">
                        <p>Phân Loại</p>
                    </div>
                    <div class="title_price">
                        <p>Thương Hiệu</p>
                    </div>
                    <div class="title_status">
                        <p>Trạng Thái</p>
                    </div>
                    <div class="title_quantiry">
                        <p></p>
                    </div>
                </div>
                <?php foreach ($ket_qua_product as $product): ?>
                <div class="view_product_detail">
                    <div class="id_product">
                        <p class="p_product"><?php echo $product['OrderID']?></p>
                    </div>
                    <div class="name_product">
                        <p class="p_product"><?php echo $product['name_product'] ?></p>
                    </div>
                    <div class="classify_product">
                        <p class="p_product"><?php echo $product['classify'] ?></p>
                    </div>
                    <div class="price_product">
                        <p class="p_product"><?php echo $product['trademark']?></p>
                    </div>
                    <div class="quantity_product">
                        <p class="title_status" style="color: hsl(214, 100%, 59%);">
                            <?php 
                                        switch($product['status_order']){
                                            case '0':
                                                echo "Còn hợp đồng";
                                                break;
                                            case '1':
                                                echo"Hết hợp đồng";
                                                break;
                                        }
                                    ?>
                        </p>
                        </p>
                    </div> 
                    <div class="function">
                        <a href="update_qlnn.php?OrderID=<?php echo $product['OrderID'] ?>&status_order=0">
                            <p class="title_price">Còn hợp đồng</p>
                        </a>
                        <a href="update_qlnn.php?OrderID=<?php echo $product['OrderID'] ?>&status_order=1">
                            <p class="">Hết hợp đồng</p>
                        </a>
                    </div>
                </div>
                <?php endforeach ?>
                <div class="number_pages">
                    <?php 
                        $sql = "SELECT ID FROM product";
                        $x = mysqli_query($conn,$sql);
                        $tongsosp = mysqli_num_rows($x);
                        $sotrang = ceil($tongsosp / $tongsosp1trang);
                        for($i=1;$i<=$sotrang;$i++){
                            echo '<a href="admin_qlnn.php?page='.$i.'" class="number_page"><li>'.$i.'</li></a>' ;
                        }
                    ?>
                </div>
            </div>

        </div>

    </div>
</body>
</html>