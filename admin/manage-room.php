<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Room</h1>
        <br /> <br />

        <!-- Button to add food -->
        <a href="<?php echo SITEURL;?>admin/add-room.php" class="btn-primary">Add Room</a>
        <br /> <br /> <br />
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <table class="tbl-full">
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM tbl_rooms";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                
                                $sql1 = "SELECT * FROM booked_rooms where `room_id` = $id";

                                //Execute the qUery
                                $res1 = mysqli_query($conn, $sql1);

                                //Count Rows to check whether we have foods or not
                                $count1 = mysqli_num_rows($res1);

                                if($count1>0)
                                {
                                    while($row1=mysqli_fetch_assoc($res1))
                                    {
                                        $ci = $row1['ci'];
                                        $co = $row1['co'];

                                        ?>

                                        <tr>
                                            <td><?php echo $sn++; ?>. </td>
                                            <td><?php echo $title; ?></td>
                                            <td>Rs.<?php echo $price; ?></td>
                                            <td>
                                                <?php  
                                                    //CHeck whether we have image or not
                                                    if($image_name=="")
                                                    {
                                                        //WE do not have image, Dislpay Error Message
                                                        echo "<div class='error'>Image not Added.</div>";
                                                    }
                                                    else
                                                    {
                                                        //WE Have Image, Display Image
                                                        ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $ci; ?></td>
                                            <td><?php echo $co; ?></td>
                                            <!-- <td><?php echo $featured; ?></td> -->
                                            <td><?php echo $active; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-room.php?id=<?php echo $id; ?>" class="btn-secondary">Update Room</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-room.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Room</a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                }

                                else {
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td>Rs.<?php echo $price; ?></td>
                                        <td>
                                            <?php  
                                                //CHeck whether we have image or not
                                                if($image_name=="")
                                                {
                                                    //WE do not have image, Dislpay Error Message
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }
                                                else
                                                {
                                                    //WE Have Image, Display Image
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td>NA</td>
                                        <td>NA</td>
                                        <!-- <td><?php echo $featured; ?></td> -->
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-room.php?id=<?php echo $id; ?>" class="btn-secondary">Update Room</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-room.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Room</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Room not Added Yet. </td> </tr>";
                        }

                    ?>
        </table>
    </div>    
</div>

<?php include("partials/footer.php"); ?>