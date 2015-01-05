<?php

require __DIR__ . '/Cart.php';

session_start();

if (isset($_SESSION['cart'])) {
    $cart = unserialize($_SESSION['cart']);
} else {
    $cart = new Cart();
}

if ('POST' === $_SERVER['REQUEST_METHOD']) {

    $cart->updateQuantities($_POST['quantity']);
    $_SESSION['cart'] = serialize($cart);

    header('Location: ./');
    exit;
}

require __DIR__ . '/view/index.dwt.php';