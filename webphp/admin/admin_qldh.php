<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_qldh.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <?php
        require '../connect.php';
        $sql = "SELECT * FROM receipt_bill";
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
        <div class="content_admin">
            <div class="banner_admin">
                <h2>CNPM QLTT</h2>
            </div>
            <div class="table_product">
                <div class="title_table_product">
                    <div class="id_product"><p class="title">Mã</p></div>
                    <div class="img_product"><p class="title">Thời gian đặt</p></div>
                    <div class="name_product"><p class="title">Tên khách hàng</p></div>
                    <div class="address_product"><p class="title">Thông tin người đặt</p></div>
                    <div class="status_product"><p class="title">Trạng Thái</p></div>
                    <div class="price_product"><p class="title">Tổng Tiền</p></div>
                    <div class="function"><p class="title">Chức Năng</p></div>
                </div>
                <?php  foreach($result as $each): ?>
                    <div class="data_product">
                        <div class="id_product"><p class="title_id"><?php echo $each['ID'] ?></p></div>
                        <div class="img_product"><p class="title_id"><?php echo $each['created_at'] ?></p></div>
                        <div class="name_product"><p class="title"><?php echo $each['name_receiver'] ?></p></div>
                        <div class="address_product">
                            <p><?php echo $each['phone_receiver'] ?></p>
                            <p><?php echo $each['address_receiver'] ?></p>
                        </div>
                        <div class="status_product">
                            <p class="title_status" style="color: hsl(214, 100%, 59%);">
                                <?php 
                                    switch($each['status']){
                                        case '0':
                                            echo "Mới đặt";
                                            break;
                                        case '1':
                                            echo"Đã duyệt";
                                            break;
                                        case '2':
                                            echo"Đã hủy";
                                            break;
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="price_product"><p class="title_price"><?php echo $each['sums'] ?></p></div>
                        <div class="function">
                            <a href="update_qldh.php?ID=<?php echo $each['ID'] ?>&status=1"><p class="title_price">Duyệt</p></a>
                            <a href="update_qldh.php?ID=<?php echo $each['ID'] ?>&status=2"><p class="title_price">Hủy Đơn</p></a>
                            <a href="view_product_qldh.php?ID=<?php echo $each['ID'] ?>"><p class="">Xem đơn</p></a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>
</html>