<section class="slider-container">
  <h2>PC Parts For Upgrades</h2>
  <div class="slider-wrapper">
    <div class="slider">
      <?php foreach ($pcParts as $part): ?>
        <div class="slide">
          <div class="slide-content">
            <img src="<?= htmlspecialchars($part['image_path']) ?>" alt="<?= htmlspecialchars($part['name']) ?>" loading="lazy">
            <h5><?= htmlspecialchars($part['name']) ?></h5>
            <h4>€<?= number_format($part['price'], 2, '.', ',') ?></h4>
            <form method="post" action="add_to_cart.php" class="add-to-cart-form">
              <input type="hidden" name="product_id" value="<?= $part['id'] ?>">
              <input type="hidden" name="product_name" value="<?= htmlspecialchars($part['name']) ?>">
              <input type="hidden" name="product_price" value="<?= $part['price'] ?>">
              <input type="hidden" name="product_image" value="<?= htmlspecialchars($part['image_path']) ?>">
              <input type="hidden" name="quantity" value="1">
              <button type="submit" class="normal">Add to Cart</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <button class="nav prev" aria-label="Previous slide">❮</button>
  <button class="nav next" aria-label="Next slide">❯</button>
  <div class="slider-dots"></div>

  <?php if (isset($_SESSION['cart_message'])): ?>
    <div class="cart-message <?= htmlspecialchars($_SESSION['cart_message']['type']) ?>">
      <?= htmlspecialchars($_SESSION['cart_message']['message']) ?>
    </div>
    <?php unset($_SESSION['cart_message']); ?>
  <?php endif; ?>
</section>

