<?php
    include('../config/constants.php');

    // 1. Get the ID of admin to be deleted
    $id = $_GET['id'];
    // 2. Create SQL query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether query is executed successfully or not
    if ($res == true) {
        // Admin deleted
        // echo "Admin deleted";
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        // Failed to delete admin
        // echo "Failed to delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // 3. Redirect to manage-admin page with message(Success/Error)
?>