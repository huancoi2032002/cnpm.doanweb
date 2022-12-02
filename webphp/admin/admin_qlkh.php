<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_qlkh.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        account_use.ID,
                        account_use.NAME_ACCOUNT,
                        account_use.NAME_USER,
                        account_use.EMAIL_ACCOUNT,
                        account_use.PASSWORD_USE,
                        account_use.PHONE_NUMBER,
                        account_use.ADDRESS_USER 
                    FROM account_use 
                    where
                    
                    ID  LIKE '%$tukhoa%' or NAME_ACCOUNT LIKE '%$tukhoa%' and NAME_USER LIKE '%$tukhoa%'
                     
                    
                    LIMIT $from,$tongsosp1trang";
        }else{
            $from = ($page - 1) * $tongsosp1trang;
            $sql = "SELECT 
                account_use.ID,
                account_use.NAME_ACCOUNT,
                account_use.NAME_USER,
                account_use.EMAIL_ACCOUNT,
                account_use.PASSWORD_USE,
                account_use.PHONE_NUMBER,
                account_use.ADDRESS_USER
            From account_use 
            LIMIT $from,$tongsosp1trang
            ";
            
        }
        $list_account = mysqli_query($conn,$sql);
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
            <form method="GET" role="form">
                <div class="search">
                    <div class="input_search"><input type="text" name="search"></div>
                    <div class="btn_search"><button type="submit">Tìm kiếm</button></div>
                </div>
            </form>
            <div class="list_account">
                <div class="title">
                    <div class="id"><p>ID</p></div>
                    <div class="name"><p>Tên Khách Hàng</p></div>
                    <div class="name_account"><p>Tên Tài Khoản</p></div>
                    <div class="email"><p>Email</p></div>
                    <div class="password"><p>Mật Khẩu</p></div>
                    <div class="phonenumber"><p>Số Điện Thoại</p></div>
                    <div class="address"><p>Địa Chỉ</p></div>
                    <div class="function"><p>Thao Tác</p></div>
                </div>
                <?php foreach ($list_account as $account){ ?>
                    <div class="data">
                        <div class="id"><p><?php echo $account['ID']?></p></div>
                        <div class="name"><p><?php echo $account['NAME_USER']?></p></div>
                        <div class="name_account"><p><?php echo $account['NAME_ACCOUNT']?></p></div>
                        <div class="email"><p><?php echo $account['EMAIL_ACCOUNT']?></p></div>
                        <div class="password"><p><?php echo $account['PASSWORD_USE']?></p></div>
                        <div class="phonenumber"><p><?php echo $account['PHONE_NUMBER']?></p></div>
                        <div class="address"><p><?php echo $account['ADDRESS_USER']?></p></div>
                        <div class="function"><p><a href="admin_qlkh_delete.php?ID=<?php echo $account['ID'];?>"><i class="fa fa-trash"></i></a></p></div>
                    </div>
                <?php } ?>
                <div class="number_pages">
                    <?php 
                        $sql = "SELECT ID FROM account_use";
                        $x = mysqli_query($conn,$sql);
                        $tongsosp = mysqli_num_rows($x);
                        $sotrang = ceil($tongsosp / $tongsosp1trang);
                        for($i=1;$i<=$sotrang;$i++){
                            echo '<a href="admin_qlkh.php?page='.$i.'" class="number_page"><li>'.$i.'</li></a>' ;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>