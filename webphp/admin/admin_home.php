<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_home.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <?php
        require '../connect.php';
        $max_date = 7;
        $sql = "SELECT 
            DATE_FORMAT(created_at,'%d-%m') as 'ngay',
            sum(sums) as 'doanh_thu'
        From `receipt_bill`
        where DATE(created_at) >= CURDATE() - INTERVAL $max_date DAY
        group by DATE_FORMAT(created_at,'%e-%m');
        ";
        $result = mysqli_query($conn,$sql);
        $arr = [];
        //echo json_encode($arr);
        
        $today = date('d');
        if($today < $max_date){
            $day_last_month = $max_date - $today;
            $last_month = date('m', strtotime("-1 month"));
            $last_month_date = date('Y-m-d', strtotime("-1 month"));
            $max_day_last_month = (new DateTime($last_month_date))->format('t');
            $start_day_last_month = $max_day_last_month - $day_last_month;
            for($i = $start_day_last_month; $i <= $max_day_last_month; $i++){
                $key = $i . '-' . $last_month; 
                $arr[$key] = 0;
            }
            $start_date_this_month = 1;
        } else{
            $start_date_this_month = $today - $max_date;
        }
        $this_month = date('m');
        
        
        for($i = 1; $i <= $today; $i++){
            $key = $i . '-' . $this_month; 
            $arr[$key] = 0;
        }
        foreach($result as $each){
            $arr[$each['ngay']] = $each['doanh_thu'];
        }
        $arrX = array_keys($arr);
        $arrY = array_values($arr)
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
            <div class="bieu_do">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">
                        Chart showing data loaded dynamically. The individual data points can
                        be clicked to display more information.
                    </p>
                </figure>
            </div>
        </div>
        
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        Highcharts.chart('container', {

            title: {
                text: 'Thống kê doanh thu theo tháng'
            },


            yAxis: {
                title: {
                    text: 'Doanh thu'
                }
            },

            xAxis: {
                categories: <?php echo json_encode($arrX) ?>
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                    connectorAllowed: false
                    },
                }
            },

            series: [{
                name: 'Doanh thu',
                data: [43934, 48656, 65165, 81827, 112143, 142383,
                    171533, 165174, 155157, 161454, 154610]
            }],

            responsive: {
                rules: [{
                    condition: {
                    maxWidth: 500
                    },
                    chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                    }
                }]
            }

        });
    </script>
</body>
</html>