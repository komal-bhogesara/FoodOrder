<?php
    include('partials-front/menu.php');
?>
<?php
    session_start();
    unset($_SESSION['loggedin']);
    $_SESSION['loggedout'] = "<div class='success'>Logged out Successfully.</div>";
    header('location:'.SITEURL.'index.php');
?>