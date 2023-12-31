<?php
session_start();
$id = $_SESSION['u']['userid'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>wishlist</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">\




</head>

<body>
    <?php include 'header.php'; ?>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php


                    $wishlistsql = "SELECT * FROM wishlist WHERE userid='$id';";
                    $wishlistresult = $connect->query($wishlistsql);

                    if ($wishlistresult->num_rows > 0) {
                        echo '<div class="shoping__cart__table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="shoping__product">Products</th>
                                                
                                                <th>price</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                        while ($row = $wishlistresult->fetch_assoc()) {
                            $productId = $row['pid'];
                            $sqlProducts = "SELECT * FROM products WHERE pid='$productId';";
                            $resultProducts = mysqli_query($connect, $sqlProducts);
                            while ($product = $resultProducts->fetch_assoc()) {
                                $sqlImages = "SELECT image FROM products_image WHERE pid = $productId AND prt = 1";
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
                                echo '<td class="shoping__cart__item__close text-center">
                <a href="delete_wishlist.php?pid=' . $productId . '" class="btn btn-outline-danger btn-md">
                    <i class="fa fa-trash"></i> Delete
                </a>
              </td>';
                                echo '   </tr>';


                            }
                        }
                        echo '   </tbody>
                                    </table>
                                </div>';
                    } else {
                        echo 'No items found in the wishlist.';
                    }

                    $connect->close();
                    ?>

                </div>
            </div>

        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <?php include 'footer.php'; ?>
</body>

</html>