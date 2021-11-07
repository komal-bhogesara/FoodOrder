<?php
    include('partials-front/menu.php');
?>
<?php
if(isset($_SESSION['loginmsg'])){
    echo $_SESSION['loginmsg'];
    unset($_SESSION['loginmsg']);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
   $username = $_POST["username"];
   $password = md5($_POST["password"]);
   
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        session_start();
        $_SESSION['loggedin'] = "<div class='success'>Set!</div>";
        $_SESSION['loginmsg'] = "<div class='success'>Loggedin Successfully.</div>";
        header('location:'.SITEURL.'index.php');
    }
    else {
        $_SESSION['loginmsg'] = "<div class='error text-center'>Invalid Credentials.</div>";
        header('location:'.SITEURL.'login.php');
   }
 }

?>
    <!-- <div class="container my-4">
        <h1 class="text-center">Login to our website</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div> -->

    <div class="container">
            
        <h2 class="text-center">Login to our website</h2>

        <form action="" class="order" method="POST">
            <fieldset style="background-color:#00b8e6;">
                <div class="order-label">Username</div>
                <input type="text" name="username" class="input-responsive" required>

                <div class="order-label">Password</div>
                <input type="password" name="password"  class="input-responsive" required>

                <input type="submit" name="submit" value="Login" class="btn btn-primary">
            </fieldset>

        </form>
    </div>
<?php 
        include('partials-front/footer.php');
?>