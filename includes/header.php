<?php $currentPage = basename($_SERVER['PHP_SELF'], ".php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Gateway | Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="img/logo/logo.png">
</head>
<button onclick="topFunction()" id="myBtn" title="Go to top">Back to Top &uarr;</button>
<section id="header" style="display: flex">
        <a href="index.php" class="logo" alt=""><img src="img/logo/logo.png"><h1>PC Gateway</h1></a>
        <div>
            <ul id="navbar">
                <li><a class="<?= $currentPage == 'index' ? 'active' : '' ?>" href="index.php">Home</a></li>
                <li><a class="<?= $currentPage == 'shop' ? 'active' : '' ?>" href="shop.php">Shop</a></li>
                <li><a class="<?= $currentPage == 'about' ? 'active' : '' ?>" href="about.php">About</a></li>
                <li><a class="<?= $currentPage == 'contact' ? 'active' : '' ?>" href="contact.php">Contact</a></li>
                <li id="bag"><a class="<?= $currentPage == 'cart' ? 'active' : '' ?>" href="cart.php"><i class="fa fa-shopping-cart cart"></i></a></li>
                <li style="color: white">&#x1F50E;&#xFE0E;</li>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i href="cart.php" class="fa fa-shopping-cart cart"></i>
            <i id="bar" class='fa fa-outdent'></i>
        </div>
</section>