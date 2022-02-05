<?php
    include('partials-front/menu.php');
    $id = $_GET['food_id'];
    $sql = "SELECT * FROM `cart` where food_id=$id";
    $res = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($res);
    if($cnt > 0){
        $_SESSION['addtocart'] = "<div class='error'>Item is already added to cart!</div>";
        header('location:'.SITEURL.'index.php');
    } else {
        $sql1 = "INSERT INTO `cart` (`food_id`,`qty`) VALUES($id, 1)";
        $res1 = mysqli_query($conn, $sql1);
        $_SESSION['addtocart'] = "<div class='success'>Item added to cart!</div>";
        header('location:'.SITEURL.'index.php');
    }
?>