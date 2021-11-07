<?php
    include('partials-front/menu.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $username = $_POST["username"];
   $password = md5($_POST["password"]);
   $cpassword = md5($_POST["cpassword"]);
   $contact = $_POST['contact'];
   $email = $_POST['email'];
   $address = $_POST['address'];

   $existSql = "SELECT * FROM `users` WHERE username ='$username'";
   $result = mysqli_query($conn, $existSql);
   $numExistsRows = mysqli_num_rows($result);
   if($numExistsRows > 0){
        $_SESSION['reg-error'] = "<div class='error'>Username Already Exists</div>";
        header('location:'.SITEURL.'index.php');
   } else {
       if($password == $cpassword ){
            // $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$password', current_timestamp())";
            $sql = "INSERT INTO `users` (`username`, `password`, `date`, `email`, `contact`, `address`) VALUES ('$username', '$password', current_timestamp(), '$email', '$contact', '$address')";
            $result = mysqli_query($conn, $sql);
            $_SESSION['registered'] =  "<div class='success'>Registered Successfully! You can login now.</div>";
            header('location:'.SITEURL.'index.php');
        }else{
            $_SESSION['reg-error'] = "<div error='success'>Passwords do not match</div>";
            header('location:'.SITEURL.'index.php');
        }
    }
}

?>
    <!-- <div class="container">
        <h1 class="text-center">Signup to our website</h1>
        <form action="" class="order" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" maxlength="23" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" maxlength="23" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div> -->


    <div class="container">
            
        <h2 class="text-center">Register On Our Site</h2>

        <form action="" class="order" method="POST">
            <fieldset style="background-color:#00b8e6;">
                <div class="order-label">Username</div>
                <input type="text" name="username" placeholder="E.g. Vatsal Shah" class="input-responsive" required>

                <div class="order-label">Password</div>
                <input type="password" maxlength="23" name="password" class="input-responsive" required>

                <div class="order-label">Confirm Password</div>
                <input type="password" maxlength="23" name="cpassword" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vatsal.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Register" class="btn btn-primary">
            </fieldset>

        </form>
    </div>

<?php 
        include('partials-front/footer.php');
?>