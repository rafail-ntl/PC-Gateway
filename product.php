<?php
session_start();
require_once __DIR__ . '/db/Database.php';

try {
    $db = Database::getInstance();
    $pdo = $db->getConnection();

    $productId = $_GET['id'] ?? null;
    if (!$productId) {
        throw new Exception("Product ID not specified");
    }

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch();

    if (!$product) {
        throw new Exception("Product not found");
    }

    $stmt = $pdo->prepare("SELECT * FROM product_thumbnails WHERE product_id = ?");
    $stmt->execute([$productId]);
    $thumbnails = $stmt->fetchAll();

    $stmt = $pdo->prepare("SELECT * FROM product_configurations WHERE product_id = ?");
    $stmt->execute([$productId]);
    $configurations = $stmt->fetchAll();

    $stmt = $pdo->query("SELECT * FROM products WHERE id != $productId LIMIT 8");
    $featuredProducts = $stmt->fetchAll();

    $stmt = $pdo->query("SELECT * FROM pc_parts");
    $pcParts = $stmt->fetchAll();
} catch (Exception $e) {
    error_log("Product page error: " . $e->getMessage());
    die("An error occurred while loading the product. Please try again later.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Gateway | <?= htmlspecialchars($product['product_title']) ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="img/logo/logo.png">
</head>
<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Back to Top &uarr;</button>
    <?php include_once 'includes/header.php' ?>

    <?php if (isset($_SESSION['cart_message'])): ?>
        <div class="cart-message <?= htmlspecialchars($_SESSION['cart_message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['cart_message']['message']) ?>
        </div>
        <?php unset($_SESSION['cart_message']); ?>
    <?php endif; ?>

    <section id="prodetails">
        <div class="single-pro-image">
            <img src="<?= htmlspecialchars($product['main_image']) ?>" width="100%" id="main-img" alt="<?= htmlspecialchars($product['product_title']) ?>">
            <div class="small-img-group" id="thumbnail-images">
                <?php foreach ($thumbnails as $thumbnail): ?>
                    <div class="small-img-col">
                        <img src="<?= htmlspecialchars($thumbnail['thumbnail_image']) ?>" width="100%" class="small-img" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="single-pro-details">
            <h6 id="product-title"><?= htmlspecialchars($product['product_title']) ?></h6>
            <h4 id="product-description"><?= htmlspecialchars($product['product_description']) ?></h4>
            <h2 id="price"><?= htmlspecialchars($product['price']) ?></h2>

            <?php if (!empty($configurations)): ?>
                <select id="configurations">
                    <?php foreach ($configurations as $config): ?>
                        <option value="<?= htmlspecialchars($config['configuration']) ?>">
                            <?= htmlspecialchars($config['configuration']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            <form method="post" action="add_to_cart.php" class="add-to-cart-form">
                <input type="number" name="quantity" min="1" value="1" id="form-quantity">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_title']) ?>">
                <input type="hidden" name="product_price" value="<?= preg_replace('/[^\d.]/', '', $product['price']) ?>">
                <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['main_image']) ?>">
                <button type="submit" class="normal">Add to Cart</button>
            </form>

            <h4>Product Details</h4>
            <span>
                <ul id="product-details-list">
                    <li>
                        Step Into The World Of High-Performance Gaming With Our Meticulously Curated PCs.
                        Select From The Best Gaming PCs Under $2000 Or Explore Our Range Under $1500,
                        All Offering Exceptional Performance And Value. Experience Top-Tier Graphics And
                        Processing Power With Our 3080 Prebuilt PCs, Delivering Impressive Performance
                        For The Most Demanding Games. Regardless Of Your Budget, Our Under $2000 And
                        $1500 Gaming PCs Ensure A Seamless And Immersive Gaming Experience Without Breaking The Bank.
                    </li>
                </ul>
            </span>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h1>Featured Products</h1>
        <p>Selected Pre-builts for maximum gaming performance</p>
        <div class="pro-container">
            <?php foreach ($featuredProducts as $featured): ?>
                <div class="pro">
                    <a href="product.php?id=<?= $featured['id'] ?>">
                        <img src="<?= htmlspecialchars($featured['main_image']) ?>" alt="<?= htmlspecialchars($featured['product_title']) ?>" style="height:320px">
                    </a>
                    <div class="des">
                        <span><?= explode(' ', $featured['product_title'])[0] ?></span>
                        <h5><?= htmlspecialchars($featured['product_title']) ?></h5>
                        <div class="star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <h4><?= htmlspecialchars($featured['price']) ?></h4>
                    </div>
                    <a href="#"><i class="fa fa-shopping-cart cart"></i></a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include_once 'includes/slider.php' ?>
    <?php include_once 'includes/newsletter.php' ?>
    <?php include_once 'includes/footer.php' ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const formQuantity = document.getElementById('form-quantity');

        if (quantityInput && formQuantity) {
            quantityInput.addEventListener('change', function() {
                formQuantity.value = this.value;
            });
        }
    });
    </script>
</body>
</html>
