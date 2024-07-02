<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .body {
        background-color: #f5f5f5;
    }

    .fa-tag:before,
    .fa-life-ring:before,
    .fa-truck:before,
    .fa-star:before {
        content: "\f005";
        color: #49a258;
    }



    .categories__item {
        height: 200px;
        position: relative;
    }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">

                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div id="carouselExample" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php

                                
                                $sqlSelectBannerImages = "SELECT * FROM banner_images";
                                $result = mysqli_query($connect, $sqlSelectBannerImages);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    ?>
                                <?php
                                    $firstItem = true;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $activeClass = ($firstItem) ? 'active' : '';
                                        $bannerImagePath = './img/banner/' . $row['image'];
                                        ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    <img class="d-block w-100" src="<?php echo $bannerImagePath; ?>" alt="Banner Image">
                                </div>
                                <?php
                                        $firstItem = false;
                                    }
                                    ?>
                                <!-- <div class="carousel-item active">
                                    <img class="d-block w-100" src="./img/65acf0257ace0.jpg" alt="Default Banner">
                                </div> -->
                                <?php
                                } else {
                                    echo 'No banner images found.';
                                }



                                ?>
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->



    <!-- Categories Section Begin -->
    <section class="categories sm-6">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php
                    include 'connect.php';


                    $sqlSelectCategories = "SELECT categoryname, image FROM category
                                           INNER JOIN cat_images ON category.catid = cat_images.catid";
                    $resultCategories = mysqli_query($connect, $sqlSelectCategories);

                    if ($resultCategories && mysqli_num_rows($resultCategories) > 0) {
                        while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
                            $categoryName = $rowCategory['categoryname'];
                            $categoryImage = '/Admin_panel/category_images/' . $rowCategory['image'];
                            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="categories__item set-bg rounded" data-setbg="<?php echo $categoryImage; ?>">
                            <h5 class="rounded"><a href="#">
                                    <?php echo $categoryName; ?>
                                </a></h5>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo 'No category images found.';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Banner Section Begin -->
    <div class="banner lg-4" style="margin-top: 125px; margin-bottom: 110px;">
        <div class="container">
            <div class="row">
                <!-- Fast Delivery -->
                <div class="col-lg-3 col-md-6">
                    <div class="banner__item text-center p-4">
                        <i class="fa fa-truck banner__icon banner__icon-green fa-3x"></i>
                        <h4 class="mt-3">Fast Delivery</h4>
                        <p class="mb-0">We ensure fast and reliable delivery to your doorstep.</p>
                    </div>
                </div>

                <!-- Best After Service -->
                <div class="col-lg-3 col-md-6">
                    <div class="banner__item text-center p-4">
                        <i class="fa fa-life-ring banner__icon banner__icon-green fa-3x"></i>
                        <h4 class="mt-3">Best After Service</h4>
                        <p class="mb-0">Our dedicated support team is ready to assist you after your purchase.</p>
                    </div>
                </div>

                <!-- Best Price -->
                <div class="col-lg-3 col-md-6">
                    <div class="banner__item text-center p-4">
                        <i class="fa fa-tag banner__icon banner__icon-green fa-3x"></i>
                        <h4 class="mt-3">Best Price</h4>
                        <p class="mb-0">Enjoy competitive prices on all our products.</p>
                    </div>
                </div>

                <!-- Best Quality -->
                <div class="col-lg-3 col-md-6">
                    <div class="banner__item text-center p-4">
                        <i class="fa fa-star banner__icon banner__icon-green fa-3x"></i>
                        <h4 class="mt-3">Best Quality</h4>
                        <p class="mb-0">We guarantee top-notch quality for all our products.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->


    <!-- Hero Section Begin -->
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="product_List.php" class="btn primary-btn rounded ">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <!-- Product 1 -->
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>

                            <!-- Product 2 -->
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>

                            <!-- Product 3 -->
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>

                            <!-- Repeat the above structure for additional products within the slider -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5 mb-4">
        <div class="container text-dark">
            <header class="">
                <h3 class="section-title">Recently viewed</h3>
            </header>

            <div class="row gy-3">
                <div class="col-lg-2 col-md-4 col-4">
                    <a href="#" class="img-wrap">
                        <img height="200" width="200" class="img-thumbnail"
                            src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/1.webp" />
                    </a>
                </div>
                <!-- col.// -->
                <div class="col-lg-2 col-md-4 col-4">
                    <a href="#" class="img-wrap">
                        <img height="200" width="200" class="img-thumbnail"
                            src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/2.webp" />
                    </a>
                </div>
                <!-- col.// -->
                <div class="col-lg-2 col-md-4 col-4">
                    <a href="#" class="img-wrap">
                        <img height="200" width="200" class="img-thumbnail"
                            src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/3.webp" />
                    </a>
                </div>
                <!-- col.// -->
                <div class="col-lg-2 col-md-4 col-4">
                    <a href="#" class="img-wrap">
                        <img height="200" width="200" class="img-thumbnail"
                            src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/4.webp" />
                    </a>
                </div>
                <!-- col.// -->
                <div class="col-lg-2 col-md-4 col-4">
                    <a href="#" class="img-wrap">
                        <img height="200" width="200" class="img-thumbnail"
                            src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/5.webp" />
                    </a>
                </div>
                <!-- col.// -->
                <div class="col-lg-2 col-md-4 col-4">
                    <a href="#" class="img-wrap">
                        <img height="200" width="200" class="img-thumbnail"
                            src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/6.webp" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">

                            <div class="latest-prdouct__slider__item">
                                <?php
                            // Assuming you have a connection to your database ($connect)
                            include 'connect.php';

                            $sqlSelectLatestProducts = "SELECT pid, name, price FROM products
                                                        ORDER BY created_at DESC
                                                        LIMIT 6"; // Limit to 6 latest products for example
                            
                            $resultLatestProducts = mysqli_query($connect, $sqlSelectLatestProducts);

                            if ($resultLatestProducts && mysqli_num_rows($resultLatestProducts) > 0) {
                                while ($rowProduct = mysqli_fetch_assoc($resultLatestProducts)) {
                                    $productId = $rowProduct['pid'];
                                    $productName = $rowProduct['name'];
                                    $productPrice = $rowProduct['price'];

                                    $sqlImages = "SELECT image FROM products_image WHERE pid = $productId AND prt = 1";
                                    $resultImages = mysqli_query($connect, $sqlImages);

                                    while ($image = $resultImages->fetch_assoc()) {
                                        ?>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="product_images/<?= $image['image'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>
                                            <?php echo $productName; ?>
                                        </h6>
                                        <span>$
                                            <?php echo $productPrice; ?>
                                        </span>
                                    </div>
                                </a>
                                <?php
                                    }
                                }
                            } else {
                                echo 'No latest products found.';
                            }
                            ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Blog Section End -->
    <?php include 'footer.php'; ?>

</body>

</html>