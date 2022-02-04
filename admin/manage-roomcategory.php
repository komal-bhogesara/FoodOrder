<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Room Category</h1>
        <br> <br>

        <?php
            if(isset($_SESSION['add-room'])){
                echo $_SESSION['add-room'];
                unset($_SESSION['add-room']);
            }

            if(isset($_SESSION['remove-room'])){
                echo $_SESSION['remove-room'];
                unset($_SESSION['remove-room']);
            }

            if(isset($_SESSION['delete-room'])){
                echo $_SESSION['delete-room'];
                unset($_SESSION['delete-room']);
            }

            if(isset($_SESSION['no-room-category-found'])) {
                echo $_SESSION['no-room-category-found'];
                unset($_SESSION['no-room-category-found']);
            }

            if(isset($_SESSION['update-room'])) {
                echo $_SESSION['update-room'];
                unset($_SESSION['update-room']);
            }

            if(isset($_SESSION['upload-room'])) {
                echo $_SESSION['upload-room'];
                unset($_SESSION['upload-room']);
            }

            if(isset($_SESSION['failed-remove-img'])) {
                echo $_SESSION['failed-remove-img'];
                unset($_SESSION['failed-remove-img']);
            }
        ?>

        <br><br>
        
        <!-- Button to add category -->
        <a href="<?php echo SITEURL;?>admin/add-roomcategory.php" class="btn-primary">Add Category</a>
        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>Sr.No.</th>
                <th>Title</th>
                <th>Image</th>
                <!-- <th>Featured</th> -->
                <th>Active</th>
                <th>Actions</th>

            </tr>

            <?php
                // Query to get all categories from database
                $sql = "SELECT * FROM tbl_roomcategory";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count rows
                $count = mysqli_num_rows($res);

                // Create serial no. variable
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured']; 
                        $active = $row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>

                            <td>
                                <?php
                                    // Check if image name is available
                                    if ($image_name == "") {
                                        // Display the message
                                        echo "<div class='error'>Image Not Added</div>";
                                    } 
                                    else {
                                        // Display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="120px">
                                        <?php
                                    }
                                ?>
                            </td>

                            <!-- <td><?php echo $featured; ?></td> -->
                            <td><?php echo $active; ?></td>

                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-roomcategory.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-roomcategory.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else {
                    // We will display message inside table
                    ?>
                    
                    <tr>
                        <td colspan="6"><div class="error">No Category Added</div></td>
                    </tr>

                    <?php
                }
            ?>
        </table>
    </div>    
</div>

<?php include("partials/footer.php"); ?>