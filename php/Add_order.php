<?php
include 'header.php';

if (isset($_GET['addressid'])) {

    $addressid = $_GET['addressid'];
    $userId = $_SESSION['u']['userid'];
    $cartid = checkOrCreateCart();


    $cartProducts = getCartProducts($cartId);
    $totalPrice = calculateNetPrice($cartProducts);
    $status = 'new';


    $query = "INSERT INTO `orders` (cartid, userid, addressid, tprice ,status) VALUES ('$cartid', '$userId', '$addressid', '$totalPrice','$status')";


    $result = mysqli_query($connect, $query);
    if ($result) {
        echo '  <script>
                            window.location.href = "order_conform.php?conform=1&cartid=' . $cartid . '";
                            </script>';

    }
}
include 'footer.php';
?>