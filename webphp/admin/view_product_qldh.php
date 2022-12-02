<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_view_product.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <?php
        require '../connect.php';
        $ID = $_GET['ID'];

        $sql = "SELECT
            receipt_bill.ID_account,
            product.img_product,
            product.name_product,
            product.classify,
            product.price_product,
            product.quantity_product,
            product.describe_product,
            receipt_bill.status,
            product.ID
        FROM
            product
        LEFT JOIN receipt_detail ON receipt_detail.product_id = product.ID
        LEFT JOIN receipt_bill ON receipt_bill.ID = receipt_detail.receipt_id
        WHERE
            product.ID = receipt_detail.product_id ;
        ";
        $result = mysqli_query($conn,$sql);
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
            <div class="banner_list"><p class="title_list">Hóa đơn</p></div>
            <div class="view_product">
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
                <?php foreach ($result as $product){ ?>
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
                                        switch($product['status']){
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
            </div>
            
        </div>
        
    </div>
</body>
</html> 