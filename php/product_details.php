<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product details</title>

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
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>
        .product__details__pic {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product__details__pic__item--large {
            width: 100%;
            max-width: 400px;
            /* Adjust as per your layout */
            height: 400px;
            /* Maintain aspect ratio */
            margin-bottom: 20px;
            object-fit: contain;
            /* Ensures the image doesn't get stretched or cropped */
            border: 1px solid #ddd;
            /* Optional: Border for the large image */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Optional: Shadow for better presentation */
        }

        .product__details__pic__slider {
            display: flex;
            gap: 10px;
            /* Space between thumbnails */
            justify-content: center;
        }

        .product__details__pic__slider img {
            width: 80px;
            /* Thumbnail width */
            height: 80px;
            /* Thumbnail height */
            object-fit: cover;
            /* Ensure thumbnails maintain aspect ratio */
            cursor: pointer;
            border: 2px solid transparent;
            /* Thumbnail border */
            transition: border-color 0.3s ease, transform 0.3s ease;
            border-radius: 5px;
            /* Optional: Rounded corners */
        }

        .product__details__pic__slider img:hover {
            border-color: #000;
            /* Highlight border on hover */
            transform: scale(1.1);
            /* Slight zoom effect on hover */
        }
    </style>

</head>

<body class="bg" style="background-color:#f6fff699;">
    <?php include 'header.php'; ?>



    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <!-- Left side: Images -->
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <?php
                        $productId = $_GET['product_id'];
                        $sqllogo = "SELECT image FROM products_image WHERE pid = $productId AND prt = 1";
                        $resultlogo = mysqli_query($connect, $sqllogo);

                        while ($logo = $resultlogo->fetch_assoc()) { ?>
                            <img class="product__details__pic__item--large"
                                src="product_images/<?php echo $logo['image']; ?>">
                        <?php } ?>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                            $sqlImages = "SELECT image FROM products_image WHERE pid = $productId";
                            $resultImages = $connect->query($sqlImages);

                            while ($image = $resultImages->fetch_assoc()) {
                                $imageArray = explode(',', $image['image']);
                                foreach ($imageArray as $imageName) { ?>
                                    <img data-imgbigurl="product_images/<?php echo $imageName; ?>"
                                        src="product_images/<?php echo $imageName; ?>" alt="Product Image">
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <!-- Right side: Product details -->
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <?php
                        $sqlProducts = "SELECT * FROM products WHERE pid = $productId ";
                        $resultProducts = mysqli_query($connect, $sqlProducts);

                        while ($product = $resultProducts->fetch_assoc()) {
                            echo '<h3>' . $product['name'] . '</h3>';
                            ?>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span></span>
                            </div>
                            <?php echo '<div class="product__details__price">' . number_format($product['price'], 2) . '</div>'; ?>

                            <p><?php echo $product['description']; ?></p>
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">

                                        <input type="text" min="1" value="1" name="qty" id="quantityInput" class="rounded">

                                    </div>
                                </div>
                            </div>
                            <a href="#" class="primary-btn" id="addToCartBtn">
                                <button type="submit" class="btn site-btn" value="addcart">add to cart
                                </button>
                            </a>
                            <a href="add_wishlist.php?pid=<?php echo $productId; ?>" class="heart-icon"><span
                                    class="icon_heart_alt"></span></a>
                            <ul>
                                <li><b>Availability</b>
                                    <span><?php echo ($product['stock'] == 1) ? '<span style="color: green;">In Stock</span>' : '<span style="color: red;">Out of Stock</span>'; ?></span>
                                </li>

                                <li><b>Weight</b> <span><?php echo $product['weight']; ?> kg</span></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">Description</a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc" style="margin-left:50px;margin-right:50px;">
                                        <h6>Products Infomation</h6>
                                        <p><?php echo preg_replace('/(.*?):(.*?)/', '<b>$1:</b>$2', str_replace('`', '<br>', $product['product_info'])); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- Product Details Section End -->
    <?php
    function generateBreadcrumb()
    {
        $breadcrumb = '<a href="/">Home</a>';

        // Get the current page URL
        $url = $_SERVER['REQUEST_URI'];
        $urlParts = explode('/', $url);

        $path = '/';
        foreach ($urlParts as $part) {
            if ($part !== '') {
                $path .= $part . '/';
                $breadcrumb .= ' / <a href="' . $path . '">' . ucfirst($part) . '</a>';
            }
        }

        return $breadcrumb;
    }
    ?>

    <?php include 'footer.php'; ?>


    <script>
        document.getElementById('addToCartBtn').addEventListener('click', function () {
            var qty = document.getElementById('quantityInput').value;
            var addToCartUrl = 'add_cart.php?addcart_pid=<?php echo $productId; ?>&qty=' + qty;

            // Use window.location.replace() to perform a redirect
            window.location.replace(addToCartUrl);
        });
    </script>

</body>

</html>