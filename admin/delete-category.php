<?php
    include('../config/constants.php');

    // Check whether the id and image_name value is set or not
    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        // Get the value and delete
        // echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if ($image_name != "") {
            $path = "../images/category/".$image_name;
            // Remove
            $remove = unlink($path);
            // Returns a boolean value
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                // Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            // Category deleted
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            // Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            // Failed to delete Category
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category. Try Again.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // Redirect to Manage Category Page with Message
    }
    else {
        // Redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>  