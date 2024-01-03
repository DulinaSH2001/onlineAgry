<?php function displayCart()
{
    global $connect;

    // Check or create a cart for the user
    $cartId = checkOrCreateCart();

    // Get cart products from the database
    $cartQuery = "SELECT * FROM cart_product WHERE cartid = $cartId";
    $cartResult = $connect->query($cartQuery);
    $cartProducts = $cartResult->fetch_all(MYSQLI_ASSOC);

    echo '<h2>Shopping Cart</h2>';
    if ($cartProducts) {
        echo '<ul>';
        foreach ($cartProducts as $cartProduct) {
            echo '<li>';
            echo $cartProduct['name'] . ' - $' . $cartProduct['q_price'] . ' x ' . $cartProduct['qty'];
            echo ' <a href="?delete_pid=' . $cartProduct['productid'] . '">Delete</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Your cart is empty. Please add some products.';
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

function checkOrCreateCart()
{
    global $connect;

    // Check if the user has an open cart
    $cartQuery = "SELECT * FROM cart WHERE userid = {$_SESSION['u']['userid']} AND cart_status = 0";
    $cartResult = $connect->query($cartQuery);

    if ($cartResult->num_rows > 0) {
        // User has an open cart
        $cart = $cartResult->fetch_assoc();
        return $cart['cartid'];
    } else {
        // User doesn't have an open cart, create a new one
        $insertCartQuery = "INSERT INTO cart (userid, cart_status) VALUES ({$_SESSION['u']['userid']}, 0)";
        $connect->query($insertCartQuery);

        // Return the ID of the newly created cart
        return $connect->insert_id;
    }
}
?>