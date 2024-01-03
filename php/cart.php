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

function calculateNetPrice($cartProducts)
{
    $netPrice = 0;
    foreach ($cartProducts as $cartProduct) {
        $netPrice += $cartProduct['q_price'];
    }
    return $netPrice;
}

function displayCart()
{
    global $connect;

    $cartId = checkOrCreateCart();

    $cartQuery = "SELECT * FROM cart_product WHERE cartid = $cartId";
    $cartResult = $connect->query($cartQuery);
    $cartProducts = $cartResult->fetch_all(MYSQLI_ASSOC);

    echo '<h2>Shopping Cart</h2>';
    if ($cartProducts) {
        echo '<ul>';
        foreach ($cartProducts as $cartProduct) {
            echo '<li>';
            echo $cartProduct['name'] . ' - $' . $cartProduct['q_price'] . ' x ' . $cartProduct['qty'];
            echo ' <a href="?delete_pid=' . $cartProduct['cartpdtid'] . '">Delete</a>';
            echo '</li>';
        }
        $netPrice = calculateNetPrice($cartProducts);
        echo '<a href="addaddress.php?cart_id=' . $cartId . '&net_price=' . $netPrice . '">Checkout</a>';
        echo '</ul>';
    } else {
        echo 'Your cart is empty. Please add some products.';
    }
}

function deleteFromCart($cartpdtid)
{
    global $connect;

    $cartId = checkOrCreateCart();

    $deleteQuery = "DELETE FROM cart_product WHERE cartid = $cartId AND cartpdtid = $cartpdtid";
    $connect->query($deleteQuery);
}

if (isset($_GET['delete_pid'])) {
    $deleteProductId = $_GET['delete_pid'];
    deleteFromCart($deleteProductId);
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>

    <?php include 'header.php'; ?>

    <?php
    displayCart();
    $connect->close()
        ?>

</body>

</html>