<?php
    include('partials-front/menu.php');
?>
    <div class="container">
            
            <h2 class="text-center">Book a Table</h2>
    
            <form action="" class="order" method="POST">
                <fieldset style="background-color:#00b8e6;">
                    <div class="order-label">Date</div>
                    <input type="date" name="username" class="input-responsive" required>
    
                    <div class="order-label">Time</div>
                    <input type="time" name="contact" class="input-responsive" required>
                    
                    <div class="order-label">Number of people</div>
                    <input type="number" name="contact" class="input-responsive" required>

                    <label for="pref" class="order-label">Give your preference :</label>
                    <select id="pref" name='pref'>
                        <option  value="1">AC</option>
                        <option  value="2">Non AC</option>
                    </select>
                    <br><br>

                    <input type="submit" name="submit" value="Book Now" class="btn btn-primary">
                </fieldset>
    
            </form>
        </div>

<?php 
    include('partials-front/footer.php');
?>