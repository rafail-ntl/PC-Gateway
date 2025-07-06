<section id="product1" class="section-p1">
  <h1>Featured Products</h1>
  <p>Selected Pre-builts for maximum gaming performance</p>
  <div class="pro-container">
    <?php foreach ($featuredProducts as $product): ?>
      <?php $brand = explode(' ', $product['product_title'])[0]; ?>
      <div class="pro">
        <a href="product.php?id=<?= $product['id'] ?>">
          <img src="<?= htmlspecialchars($product['main_image']) ?>" alt="<?= htmlspecialchars($product['product_title']) ?>" style="height:320px">
        </a>
        <div class="des">
          <span><?= htmlspecialchars($brand) ?></span>
          <h5><?= htmlspecialchars($product['product_title']) ?></h5>
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h4><?= htmlspecialchars($product['price']) ?></h4>
        </div>
        <a href="#"><i class="fa fa-shopping-cart cart"></i></a>
      </div>
    <?php endforeach; ?>
  </div>
</section>