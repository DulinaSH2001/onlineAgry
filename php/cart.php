<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <?php
    include 'header.php';
    if (!isset($_SESSION['u']['userid'])) {
        header("Location: login.php");
        exit;
    } else {

        $userId = $_SESSION['u']['userid'];



        function displayCart()
        {
            global $connect;

            $cartId = checkOrCreateCart();

            $cartQuery = "SELECT * FROM cart_product WHERE cartid = $cartId";
            $cartResult = $connect->query($cartQuery);
            $cartProducts = $cartResult->fetch_all(MYSQLI_ASSOC);

            echo '<h2>Shopping Cart</h2>';
            if ($cartProducts) {
                echo ' <table>
                <thead>
                    <tr>
                        <th class="shoping__product">Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>      </th>
                        <th></th>
                    </tr>
                </thead>';
                foreach ($cartProducts as $cartProduct) {
                    $productid = $cartProduct['productid'];
                    $sqlProducts = "SELECT * FROM products WHERE pid='$productid';";
                    $resultProducts = mysqli_query($connect, $sqlProducts);
                    while ($product = $resultProducts->fetch_assoc()) {
                        $sqlImages = "SELECT image FROM products_image WHERE pid = $productid AND prt = 1";
                        $resultImages = mysqli_query($connect, $sqlImages);

                        while ($image = $resultImages->fetch_assoc()) {
                            echo '   <tr>';
                            echo ' <td class="shoping__cart__item">';
                            echo '<img src="product_images/' . $image['image'] . '" width="101" height="100" alt="Responsive image">';
                        }
                        echo '<h5>' . $product['name'] . '</h5>';
                        echo ' </td>
                                    <td class="shoping__cart__price">' . $product['price'] . '';
                        echo ' </td>';
                        echo ' 
                        <td class="shoping__cart__price">' . $cartProduct['qty'] . '';
                        echo ' </td>';
                        echo ' 
                        <td class="shoping__cart__price">' . $cartProduct['q_price'] . '';
                        echo ' </td>';





                        echo ' <td class="shoping__cart__item__close text-center"><a href="?delete_pid=' . $cartProduct['cartpdtid'] . '"class="btn btn-outline-danger btn-md">
                    <i class="fa fa-trash"></i> Delete
                </a>
              </td>';


                        echo '   </tr>';


                    }
                }



                echo '   </tbody>
                    </table>';
                $netPrice = calculateNetPrice($cartProducts);

                echo '            </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                    <a href="product_List.php" class="primary-btn cart-btn-right">CONTINUE SHOPPING</a>
                       
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                           
                            <form action="#">
                               
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>' . $netPrice . '</span></li>
                            <li>Total <span>' . $netPrice . '</span></li>
                        </ul>
                        <a href="select_address.php?cart_id=' . $cartId . '&net_price=' . $netPrice . ' " class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>';




            } else {
                echo '<div class="alert alert-warning" role="alert">';
                echo 'Your cart is empty. Please add some products.';
                echo '</div>';
                echo '<script>
                        setTimeout(function() {
                           window.location.href = "product_List.php";
                            }, 2000); // 5000 milliseconds = 5 seconds
                         </script>';

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

            // JavaScript code for self-refresh
            echo '<script>window.location.href = "cart.php";</script>';
            exit;
        }
        ?>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">




                        <?php

                            displayCart();
    }
    ob_end_flush();
    ?>

                        <?php include 'footer.php' ?>

                        </body>

</html>