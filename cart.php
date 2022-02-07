<?php
    include('partials-front/menu.php');
?>
<?php
    if(isset($_POST['quantity'])){
        $quantity = $_POST['quantity'];
        $sno = $_POST['sno'];
        $sql = "UPDATE `cart` SET `qty` = $quantity WHERE `cart`.`sno` = $sno"; 
        $result = mysqli_query($conn, $sql);
    }
    if(isset($_POST['submit'])){
        // echo "Button pressed";
        $cart_sno = $_POST['cart_sno'];
        $sql1 = "DELETE FROM `cart` where `sno`= $cart_sno";
        $result = mysqli_query($conn, $sql1);
        header('location:'.SITEURL.'cart.php');
    }
?>
<section class="food-search text-center">
        <div class="container text-center">
            <h2>CART</h2>
        </div>
</section>
<?php
    if(isset($_POST['placeOrder'])){
        $_SESSION['orderPlaced'] = "<div class='success'>Your Order has been placed successfully!</div>";
        header('location:'.SITEURL.'index.php');
    }
?>
<fieldset class="cart order">
            <table class="table">
            <tbody>
            <tr>
            <td></td>
            <td>ITEM NAME</td>
            <td>QUANTITY</td>
            <td>UNIT PRICE</td>
            <td>ITEMS TOTAL</td>
            </tr>
<?php
$total_price = 0;
$result = mysqli_query($conn,"SELECT * FROM `cart`");
while($row = mysqli_fetch_assoc($result)){
    $tbl_id = $row['food_id'];
    $qty = $row['qty'];
    $sno = $row['sno'];
    $sql = "SELECT * FROM `tbl_food` where id=$tbl_id";
    $res = mysqli_query($conn, $sql);
    while($row1 = mysqli_fetch_assoc($res)){
            $title = $row1['title'];
            $price = $row1['price'];
            $description = $row1['description'];
            $image_name = $row1['image_name'];
		?>
            	

            <tr>
            <td><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="50" height="40" /></td>
            <td><?php echo $title; ?><br />
            <form method='post' action=''>
                <input type='hidden' name='cart_sno' value="<?php echo $sno; ?>" />
                <button type='submit' name='submit' class='remove'>Remove Item</button>
            </form>
            </td>
            <td>
            <form method='post' action=''>
                <input type='hidden' name='action' value="change" />
                <input type='hidden' name='sno' value="<?php echo $sno; ?>"/>
                <select name='quantity' class='quantity' onchange="this.form.submit()">
                    <option <?php if($qty == 1) {echo "selected";} ?> value="1">1</option>
                    <option <?php if($qty == 2) {echo "selected";} ?> value="2">2</option>
                    <option <?php if($qty == 3) {echo "selected";} ?> value="3">3</option>
                    <option <?php if($qty == 4) {echo "selected";} ?> value="4">4</option>
                    <option <?php if($qty == 5) {echo "selected";} ?> value="5">5</option>
                    <option <?php if($qty == 6) {echo "selected";} ?> value="6">6</option>

                </select>
            </form>
            </td>
            <td><?php echo $price; ?></td>
            <?php
                $total = $price*$qty;
            ?>
            <td><?php echo $total; ?></td>

            <!-- total price per item = price*qty -->
            </tr>
            <?php
            //Overall total
            $total_price += $total; 
    }
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "Rs.".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>

<?php
if(isset($_SESSION['loggedin'])){
    ?>
    <br>
    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Place Order</a>
    <?php 
}

else {
    ?>
    <br>
    <a href="<?php echo SITEURL; ?>login.php" class="btn btn-primary">Place Order</a>
    <?php 
}
?>		

</fieldset>
<?php
    include('partials-front/footer.php');
?>