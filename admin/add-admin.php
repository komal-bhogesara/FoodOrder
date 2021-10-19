<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>

        <?php
            if(isset($_SESSION['add'])) {   
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
             <table class="tbl-30">
                 <tr>
                     <td>Full Name: </td>
                     <td><input type="text" name="full_name" placeholder="Your name"></td>
                 </tr>

                 <tr>
                     <td>Username: </td>
                     <td><input type="text" name="username" placeholder="Your username"></td>
                 </tr>

                 <tr>
                     <td>Password: </td>
                     <td><input type="password" name="password" placeholder="Your password"></td>
                 </tr>

                 <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                 </tr>
             </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php"); ?>

<?php
    // Process the value from form and save it in Database

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])) {
        // Button Clicked
        // echo "Button Clicked";

        //1. Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);    //Password encryption with MD5

        // 2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        // 3. Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether the data is inserted or not
        if ($res == TRUE) {
            // Data inserted
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Addded Successfully</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else {
            // Failed to insert data
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed To Add Admin</div>";
            // Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>