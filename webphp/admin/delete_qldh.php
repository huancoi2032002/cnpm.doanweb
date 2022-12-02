<?php 
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
</head>
<body>
    <?php 
        $ID = 61;
        var_dump($cart = $_SESSION['cart'][$ID]['quantity']) ;
    ?>
</body>
</html>