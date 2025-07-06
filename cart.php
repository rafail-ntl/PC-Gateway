<?php
session_start();
include_once 'includes/header.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['cart_message'] = [
            'type' => 'success',
            'message' => 'Item removed from cart'
        ];
    }
    header('Location: cart.php');
    exit;
}

if (isset($_POST['update_quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    
    if ($quantity <= 0) {
        unset($_SESSION['cart'][$product_id]);
    } elseif (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
    header('Location: cart.php');
    exit;
}

$subtotal = 0;
$total = 0;
$cart_count = 0;

foreach ($_SESSION['cart'] as $item) {
    $item_subtotal = $item['price'] * $item['quantity'];
    $subtotal += $item_subtotal;
    $cart_count += $item['quantity'];
}

$total = $subtotal;
?>

<section id="cart" class="section-p1">
    <h2>Shopping Cart</h2>
    
    <?php if (isset($_SESSION['cart_message'])): ?>
        <div class="cart-message <?= htmlspecialchars($_SESSION['cart_message']['type']) ?>">
            <?= htmlspecialchars($_SESSION['cart_message']['message']) ?>
        </div>
        <?php unset($_SESSION['cart_message']); ?>
    <?php endif; ?>
    
    <?php if (empty($_SESSION['cart'])): ?>
        <div class="empty-cart">
            <p>Your cart is empty</p>
            <a href="shop.php" class="normal">Continue Shopping</a>
        </div>
    <?php else: ?>
        <table width="100%" class="cart-table">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <?php 
                        $item_subtotal = (float)$item['price'] * (int)$item['quantity'];
                    ?>
                    <tr>
                        <td>
                            <a href="cart.php?remove=<?= $id ?>" class="remove-btn" title="Remove item">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                        <td>
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="70" loading="lazy">
                        </td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>&euro;<?= number_format((float)preg_replace('/[^0-9.]/', '', $item['price']), 2) ?></td>
                        <td>
                            <form method="post" action="cart.php" class="quantity-form">
                                <input type="hidden" name="product_id" value="<?= $id ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                                <button type="submit" name="update_quantity" class="update-btn normal">Update</button>
                            </form>
                        </td>
                        <td>&euro;<?= number_format($item_subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php if (!empty($_SESSION['cart'])): ?>
<section id="cart-add" class="section-p1">
    <div id="coupon">
        <h3>Apply Coupon</h3>
        <div class="coupon-form">
            <input id="coupon-input" type="text" placeholder="Enter Your Coupon">
            <button id="apply-coupon" class="normal">Apply</button>
        </div>
    </div>
    <div id="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td id="total-price1">&euro;<?= number_format($subtotal, 2) ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>                
            </tr>
            <tr>
                <td><strong>Coupon</strong></td>
                <td id="coupon-price">NA</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong id="total-price2">&euro;<?= number_format($total, 2) ?></strong></td>
            </tr>
        </table>
        <button class="normal checkout-btn">Proceed to Checkout</button>
    </div>
</section>
<?php endif; ?>

<?php include_once 'includes/newsletter.php' ?>
<?php include_once 'includes/footer.php' ?>