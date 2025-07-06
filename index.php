<?php

require_once __DIR__ . '/db/Database.php';

try {
  $db = Database::getInstance();
  $pdo = $db->getConnection();

  $stmt = $pdo->query("SELECT * FROM products LIMIT 8");
  $featuredProducts = $stmt->fetchAll();

  $stmt = $pdo->query("SELECT * FROM pc_parts");
  $pcParts = $stmt->fetchAll();
} catch (Exception $e) {
  error_log("Index page error: " . $e->getMessage());
  $featuredProducts = [];
  $pcParts = [];
}
?>


<?php include_once 'includes/header.php' ?>
<section id="hero">
  <h4>We know what you need</h4>
  <h2>Special deals</h2>
  <h1>On all products</h1>
  <p>Save more with coupons & up to 70% off! </p>
  <a href="shop.php"><button>SHOP NOW</button></a>
</section>

<section id="feature" class="section-p1">
  <div class="fe-box">
    <img src="img/features/free-shipping.png" alt="">
    <h6>Free Shipping</h6>
  </div>
  <div class="fe-box">
    <img src="img/features/return.png" alt="">
    <h6>Free Return</h6>
  </div>
  <div class="fe-box">
    <img src="img/features/save-money.png" alt="">
    <h6>Save Money</h6>
  </div>
  <div class="fe-box">
    <img src="img/features/support.png" alt="">
    <h6>24/7 Support</h6>
  </div>
  <div class="fe-box">
    <img src="img/features/repair.png" alt="">
    <h6>Repair Services</h6>
  </div>
  <div class="fe-box">
    <img src="img/features/eco-friendly.png" alt="">
    <h6>Eco Friendly</h6>
  </div>
</section>

<?php include_once 'includes/products.php'?>
<?php include_once 'includes/slider.php'?>
<?php include_once 'includes/banner.php'?>
<?php include_once 'includes/newsletter.php' ?>
<?php include_once 'includes/footer.php' ?>
<?php include_once 'includes/slider.php' ?>
</body>

</html>