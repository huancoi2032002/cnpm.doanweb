<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require '../connect.php';
    $ID = $_GET['ID'];
    if (isset($_POST['btn_update_product'])) {
        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
        $img_product = $_POST['img_product'];
        $name_product = $_POST['name_product'];
        $classify = $_POST['classify'];
        $price_product = $_POST['price_product'];
        $quantity_product = $_POST['quantity_product'];
        $describe_product = $_POST['describe_product'];
        
        // Câu lệnh UPDATE
        $sql = "UPDATE `product` 
        SET img_product='$img_product',
         name_product='$name_product', 
         classify='$classify', 
         price_product='$price_product', 
         quantity_product='$quantity_product',
         describe_product='$describe_product' 
         WHERE ID=$ID;";

        // Thực thi UPDATE
        mysqli_query($conn, $sql);

        // Đóng kết nối
        mysqli_close($conn);
        header('location:admin_qlsp.php');
        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wIDth=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin_update_product.css" type="text/css" />
</head>
<body>
    
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
        <?php 
            $sql = "SELECT * FROM product where ID = '$ID'";
            $result = mysqli_query($conn,$sql);
            $each = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>
        <div class="menu_product">
            <div class="banner_add"><p class="title_add">Sửa Sản Phẩm</p class="title_add"></div>
            <form method="post" action="" role="form">
                <div class="add_product">
                    <p class="title_product">Hình Ảnh Sản Phẩm</p>
                    <input class="input_product" name="img_product" value='<?php echo $each['img_product'] ?>'>
                    <p class="title_product">Tên Sản Phẩm</p>
                    <input class="input_product" name="name_product" value='<?php echo $each['name_product'] ?>'>
                    <p class="title_product">Danh Mục</p>
                    <select name="classify">
                        <option>--Chọn--</option>
                        <option <?php if (isset($classify) && $classify == 'Ao') echo "selected=\"selected\"";  ?>  value="Ao" >Áo</option>
                        <option <?php if (isset($classify) && $classify == 'Quan') echo "selected=\"selected\"";  ?> value="Quan">Quần</option>
                        <option <?php if (isset($classify) && $classify == 'Phu_kien') echo "selected=\"selected\"";  ?> value="Phu_kien">Phụ kiện</option>
                    </select>
                    <p class="title_product">Giá Sản Phẩm</p>
                    <input class="input_product" name="price_product" value='<?php echo $each['price_product'] ?>'>
                    <p class="title_product">Số Lượng Sản Phẩm</p>
                    <input class="input_product" name="quantity_product" value='<?php echo $each['quantity_product'] ?>'>
                    <p class="title_product">Mô Tả Sản Phẩm</p>
                    <textarea class="describe" name="describe_product" value='<?php echo $each['describe_product'] ?>'></textarea>
                    <div>
                        <button name="btn_update_product"><a href="">Sửa Sản Phẩm</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>