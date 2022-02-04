<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Room Category</h1>

        <br><br>

        <?php
            // Check whether ID is set or not
            if (isset($_GET['id'])) {
                // echo "Getting the data";
                $id = $_GET['id'];

                $sql = "SELECT * FROM  tbl_roomcategory WHERE id = $id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else {
                    // Redirect to manage category page
                    $_SESSION['no-room-category-found'] = "<div class='error'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-roomcategory.php');
                }
            }
            else {
                // Redirect to manage category
                header('location:'.SITEURL.'admin/manage-roomcategory.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                        if ($current_image != "") {
                            // Display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="120px">
                            <?php
                        }
                        else {
                            // Display message
                            echo "<div class='error'>Image Not Added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_img" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                //1. Get all the value from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_img'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image Available

                        //A. Upload the New Image

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload-room'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'admin/manage-roomcategory.php');
                            //Stop the Process
                            die();
                        }

                        //B. Remove the Current Image if available
                        if($current_image!="") {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove-img'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-roomcategory.php');
                                die();//Stop the Process
                            }
                        }
                    }
                    else {
                        $image_name = $current_image;
                    }
                }
                else {
                    $image_name = $current_image;
                }
                

                //3. Update the Database
                $sql2 = "UPDATE tbl_roomcategory SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect to Manage Category with Message
                //CHeck whether executed or not
                if($res2==true) {
                    //Category Updated
                    $_SESSION['update-room'] = "<div class='success'>Room Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-roomcategory.php');
                }
                else {
                    //failed to update category
                    $_SESSION['update-room'] = "<div class='error'>Failed to Update Room Category.</div>";
                    header('location:'.SITEURL.'admin/manage-roomcategory.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>