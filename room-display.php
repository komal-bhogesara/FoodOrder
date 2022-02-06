<?php include('partials-front/menu.php'); ?>

<?php
    $ci = $_GET['ci'];
    $co = $_GET['co'];
?>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Rooms</h2>

        <?php 
            //Display Foods that are Active
            $sql = "SELECT * FROM tbl_rooms";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //CHeck whether the foods are availalable or not
            if($count>0)
            {
                //Foods Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $active = $row['active'];

                    if ($active == 'No') {
                        $sql1 = "SELECT * FROM booked_rooms WHERE `co` < '$ci' and `room_id` = $id";

                        //Execute the Query
                        $res1=mysqli_query($conn, $sql1);

                        //Count Rows
                        $count1 = mysqli_num_rows($res1);

                        if ($count1 > 0) {
                        ?>
                            <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Rs.<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                                <!-- <a href="<?php echo SITEURL; ?>addtocart.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add to cart</a> -->
                            </div>
                        </div>

                        <?php
                        } 
                    }
                    
                    else {
                        ?>
                        <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //CHeck whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                            <!-- <a href="<?php echo SITEURL; ?>addtocart.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add to cart</a> -->
                        </div>
                    </div>

                    <?php

                    }
                }
            }
            else
            {    
                //Food not Available
                echo "<div class='error'>Room not found.</div>";
            }
        ?>

        <div class="clearfix"></div>

        

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>