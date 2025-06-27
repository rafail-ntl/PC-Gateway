<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? null;
    $productName = $_POST['product_name'] ?? '';
    $productPrice = $_POST['product_price'] ?? '';
    $productImage = $_POST['product_image'] ?? '';
    $quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;

    if (!$productId || !$productName || !$productPrice || !$productImage) {
        $_SESSION['cart_message'] = [
            'type' => 'error',
            'message' => 'Incomplete product data.'
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    $item = [
        'id' => $productId,
        'name' => $productName,
        'price' => (float)$productPrice,
        'image' => $productImage,
        'quantity' => $quantity
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][$productId] = $item;

    $_SESSION['cart_message'] = [
        'type' => 'success',
        'message' => "{$productName} was added to your cart."
    ];

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
