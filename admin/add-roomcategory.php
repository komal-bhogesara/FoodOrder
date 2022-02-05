<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Room Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add-room'])){
                echo $_SESSION['add-room'];
                unset($_SESSION['add-room']);
            }
            if(isset($_SESSION['upload-room'])){
                echo $_SESSION['upload-room'];
                unset($_SESSION['upload-room']);
            }
        ?>

        <br><br>

        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
             <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form end -->
        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                //for radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                // print_r($_FILES['image']);
                // die();

                if(isset($_FILES['image']['name'])){
                    //upload image
                    //to upload image we need img name, source and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload only if image name is available
                    if ($image_name != "") {
                        //Auto rename our image
                        // Get extension of image(jpg, png, gif)
                        $ext = end(explode('.', $image_name)); 

                        // Rename the image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //finally upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether img is uploaded
                        if($upload == false){
                            $_SESSION['upload-room'] = "<div class='error'>Failed to upload room image.</div>";
                            header('location:'.SITEURL.'admin/add-roomcategory.php');
                            // Stop the process
                            die();
                        } 
                    }

                } else {
                    //dont upload the image
                    $image_name = "";
                }
                //sql query to insert category
                $sql = "INSERT INTO tbl_roomcategory SET
                    title='$title',
                    image_name='$image_name', 
                    featured='$featured',
                    active='$active'
                ";
                $res = mysqli_query($conn, $sql);
                if($res == true){
                    $_SESSION['add-room'] = "<div class='success'>Room Category Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-roomcategory.php');
                } else {
                    $_SESSION['add-room'] = "<div class='error'>Failed to Add Room Category.</div>";
                    header('location:'.SITEURL.'admin/add-roomcategory.php');
                }
            }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>