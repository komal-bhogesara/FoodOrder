<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Food Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>room-categories.php">Room Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>rooms.php">Rooms</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <?php 
                        if(!isset($_SESSION['loggedin'])){ 
                    ?>
                            <li>
                                <a href="<?php echo SITEURL; ?>login.php">Login</a>
                            </li>
                            <li>
                                <a href="<?php echo SITEURL; ?>register.php">Register</a>
                            </li>
                    <?php
                        } else { 
                    ?>
                            <li>
                                <a href="<?php echo SITEURL; ?>logout.php.">Logout</a>
                            </li>
                    <?php
                        } 
                        $sql = "SELECT * FROM `cart`";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                       <li>
                        <div class="cart_div">
                            <a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $count; ?></span></a>
                        </div>
                       </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
    
</body>
    