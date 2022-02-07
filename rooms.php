<?php
    include('partials-front/menu.php');
?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Rooms</h2>

            <?php 
                //Display Foods that are Active
                // $sql = "SELECT * FROM tbl_rooms WHERE active='Yes'";
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
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
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
                                <?php
                                    if($active == 'No'){
                                        ?>
                                        <!-- <p class='error'>Booked</p> -->
                                        <br>
                                        <a class="btn" type="button" disabled>Booked</a>
                                        <?php
                                    } else {
                                        if(isset($_SESSION['loggedin'])){
                                            ?>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Book Now</a>
                                            <?php 
                                        }

                                        else {
                                            ?>
                                            <br>
                                            <a href="<?php echo SITEURL; ?>login.php" class="btn btn-primary">Book Now</a>
                                            <?php 
                                        }
                                        
                                    }
                                ?>
                                <!-- <a href="<?php echo SITEURL; ?>addtocart.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add to cart</a> -->
                            </div>
                        </div>

                        <?php
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

<?php
    include('partials-front/footer.php');
?>