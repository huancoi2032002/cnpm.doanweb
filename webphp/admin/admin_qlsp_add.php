<?php 

    ini_set('display_errors', 'ON');

    require '../connect.php';
    if(isset($_POST['btn_add_product'])){
        
        $img_product = $_POST['img_product'];
        $name_product = $_POST['name_product'];
        $classify = $_POST['classify'];
        $price_product = $_POST['price_product'];
        $quantity_product = $_POST['quantity_product'];
        $describe_product = $_POST['describe_product'];
        $trademark = $_POST['trademark'];

        $sql = "INSERT into `product`(`img_product`,`name_product`,`classify`,`price_product`,`quantity_product`,`describe_product`,`trademark`)
        values ('$img_product','$name_product','$classify','$price_product','$quantity_product','$describe_product','$trademark') ";
        mysqli_query($conn,$sql);
        if($conn->query($sql)===TRUE){
            $product_id  = mysqli_insert_id($conn);
            $sum = $quantity_product*$price_product;
            $sql_order = "INSERT into `order_bill`(`OrderTotalPrice`) values ('$sum');";
            mysqli_query($conn,$sql_order);
            if($conn->query($sql_order)===TRUE){
                $order_id  = mysqli_insert_id($conn);
                $sql_order_bill = "INSERT into `order_detail`(`OrderID`,`ProductID`,`OrderProductNum`) values ('$order_id','$product_id','$quantity_product');";
                mysqli_query($conn,$sql_order_bill);
            }
        }
        
        $sql_update_product = "delete from product
        where ID not in (select MAX(ID) from product group by name_product)";
        mysqli_query($conn,$sql_update_product);
        if($conn->query($sql_update_product)===TRUE){
            $sql_update_order_bill = "delete from order_bill
                where OrderID not in (select MAX(OrderID) from order_bill group by OrderDay)";
            mysqli_query($conn,$sql_update_order_bill); 
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_qlnn.css" type="text/css" />
    <style>
        
    </style>
</head>

<body>
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
        <div class="menu_product">
            <div class="banner_add">
                <p class="title_add"><p class="title_list"><a href="admin_qlsp_add.php">Thêm Sản Phẩm</a> | <a href="admin_qlsp.php">Danh Sách Sản Phẩm</a></p></p class="title_add">
            </div>
            <form method="post" action="" role="form">
                <div class="add_product">
                    <p class="title_product">Hình Ảnh Sản Phẩm</p>
                    <input class="input_product" name="img_product">
                    <p class="title_product">Tên Sản Phẩm</p>
                    <input class="input_product" name="name_product">
                    <p class="title_product">Danh Mục</p>
                    <select name="classify">
                        <option>--Chọn--</option>
                        <option <?php if (isset($classify) && $classify == 'Áo') echo "selected=\"selected\"";  ?>
                            value="Áo">Áo</option>
                        <option <?php if (isset($classify) && $classify == 'Quần') echo "selected=\"selected\"";  ?>
                            value="Quần">Quần</option>
                        <option <?php if (isset($classify) && $classify == 'Phụ kiện') echo "selected=\"selected\"";  ?>
                            value="Phụ kiện">Phụ kiện</option>
                    </select>
                    <p class="title_product">Giá Sản Phẩm</p>
                    <input class="input_product" name="price_product">
                    <p class="title_product">Số Lượng Sản Phẩm</p>
                    <input class="input_product" name="quantity_product">
                    <p class="title_product">Thương Hiệu</p>
                    <input class="input_product" name="trademark">
                    <p class="title_product">Mô Tả Sản Phẩm</p>
                    <textarea class="describe" name="describe_product"></textarea>
                    <div>
                        <button name="btn_add_product"><a href="">Add Product</a></button>
                    </div>
                </div>
            </form>
        </div>
        

    </div>
</body>

</html>