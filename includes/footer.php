<section id="footer" class="section-p1">
    <div class="col">
        <h2>PC Gateway</h2>
        <h4>Contact</h4>
        <p><strong>Address: </strong> Thessaloniki, Greece </p>
        <p><strong>Phone:</strong> +306912345678</p>
        <p><strong>Hours:</strong> 08:00 - 14:00, 18:00-21:00 (Mon - Sat)</p>
        <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <i class="fa fa-facebook-f"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-youtube"></i>
            </div>
            <div class="copyright">
                <p>&copy; Rafail Ntalas 2025</p>
            </div>
        </div>
    </div>
    <div class="col">
        <h4>About</h4>
        <div class="col-container">
            <a href="about.php">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="contact.php">Contact Us</a>
        </div>
    </div>
    <div class="col">
        <div class="col-container">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="cart.php">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>
    </div>
    <div class="col">
        <div class="col-container">
            <h4>Payment Methods</h4>
            <p>Secured Payment Methods</p>
            <img src="img/pay/pay.png" style="width:200px;background-color: rgb(255, 255, 255);">
        </div>
    </div>
</section>

<?php
$jsFiles = glob("js/*.js");

foreach ($jsFiles as $file) {
    echo "<script src=\"$file\"></script>\n";
}
?>