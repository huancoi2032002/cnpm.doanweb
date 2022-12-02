<?php
    ini_set('display_errors', 'OFF');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/thongke.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <?php 
        require '../connect.php';
            $created_at_1 = $_GET['created_at_1'];
            $created_at_2 = $_GET['created_at_2'];
            $sql = "SELECT sum(sums) as doanh_thu,
                    COUNT(name_receiver) as so_nguoi_dat
            FROM receipt_bill 
            where  status = 1 AND created_at >= '$created_at_1' and created_at <= '$created_at_2'";
            $result = mysqli_query($conn,$sql);
            $each = mysqli_fetch_array($result);
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
                <h2>Thống Kê</h2>
            </div>
            <div class="statistical">
                <div class="search">
                    <form method="get" role="form" action="">
                        <div class="search_detail">
                            <label>Thống kê tháng:</label>
                            <input type="date"  name="created_at_1" value="2022-11-01">
                            <input type="date"  name="created_at_2" value="2022-12-01">
                            <button name="created_at">Chọn</button>
                        </div>
                    </form>
                </div>
                <div class="statistical_detail">
                    <div class="title_statistical">
                        <div class="month">Tháng</div>
                        <div class="number_user">Số người đặt hàng</div>
                        <div class="turnover">Doanh Thu</div>
                        <div class="chi_tiet">Chi tiết</div>
                        <div class="function">Chức năng</div>
                    </div>
                    <div class="information">
                        <div class="month"><p><?php echo $created_at_1 ?></p></div>
                        <div class="number_user">
                             
                                <?php 
                                    echo $each['so_nguoi_dat'];
        
                                ?>  
                        </div>
                        <div class="turnover"><p><?php echo $each['doanh_thu'] ?>đ</p></div>
                        <div class="chi_tiet"><a href="#">Xem chi tiết</a></div>
                        <div class="function">
                            <button>Lưu</button>
                        </div>
                    </div>
                    <?php 
                        require '../connect.php';
                        $sql_sp = "SELECT
                        product.ID,
                        name_product,
                    (
                        SELECT
                        ifnull(sum(quantity),0)
                        from receipt_detail
                        join receipt_bill on receipt_bill.ID = receipt_detail.receipt_id
                        where
                        receipt_detail.product_id = product.ID AND receipt_bill.created_at >= '$created_at_1' and receipt_bill.created_at <= '$created_at_2'
                        and
                        receipt_bill.status = 1
                    ) as quantity_sales
                    from product
                    ORDER by quantity_sales DESC;";
                        $result_sp = mysqli_query($conn,$sql_sp);
                        $each_sp = mysqli_fetch_array($result_sp);
                        
                    ?>
                    <div class="so_luong">
                        <div class="tieu_de"><p>Sản phẩm bán chạy</p></div> 
                        <table >
                            <tr>
                                <th>Tháng</th>
                                <th>ID</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php 
                                        
                                            echo $created_at_1;
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php foreach ($result_sp as  $each_sp): ?>
                                        <div>
                                            <?php
                                                echo $each_sp['ID'];
                                            ?>
                                        </div>
                                    <?php endforeach ?>
                                </td>
                                <td>
                                    <?php foreach ($result_sp as  $each_sp): ?>
                                        <div>
                                            <?php echo $each_sp['name_product']; ?>
                                        </div>
                                    <?php endforeach ?>
                                </td>
                                <td>
                                    <?php foreach ($result_sp as  $each_sp): ?>
                                        <div>
                                            <?php echo $each_sp['quantity_sales']; ?>
                                        </div>
                                    <?php endforeach ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>