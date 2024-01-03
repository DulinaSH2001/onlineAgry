<?php
session_start();

include 'connect.php';

$userId = $_SESSION['u']['userid'];

function checkOrCreateCart()
{
    global $connect;

    $cartQuery = "SELECT * FROM cart WHERE userid = {$_SESSION['u']['userid']} AND cart_status = 0";
    $cartResult = $connect->query($cartQuery);

    if ($cartResult->num_rows > 0) {
        $cart = $cartResult->fetch_assoc();
        return $cart['cartid'];
    } else {
        $insertCartQuery = "INSERT INTO cart (userid, cart_status) VALUES ({$_SESSION['u']['userid']}, 0)";
        $connect->query($insertCartQuery);
        return $connect->insert_id;
    }
}

function addToCart($productId, $quantity)
{
    global $connect;

    $cartId = checkOrCreateCart();

    $productQuery = "SELECT * FROM products WHERE pid = $productId";
    $productResult = $connect->query($productQuery);

    if ($productResult === false) {
        echo "Error: " . $connect->error;
        return;
    }

    if ($productResult->num_rows > 0) {
        $product = $productResult->fetch_assoc();
        $totalPrice = $quantity * $product['price'];

        $insertQuery = "INSERT INTO cart_product (cartid, productid, name, qty, p_price, q_price) VALUES ($cartId, $productId, '{$product['name']}', $quantity, {$product['price']}, $totalPrice)";
        $connect->query($insertQuery);
    } else {
        echo "Product not found";
    }

    // Redirect to cart.php after adding the product to the cart
    header("Location: cart.php");
    exit;
}
if (isset($_GET['addcart_pid']) && isset($_GET['qty'])) {
    $productId = $_GET['addcart_pid'];
    $quantity = $_GET['qty'];


    addToCart($productId, $quantity);
}
?>