<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
    .product__pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .product__item {
        margin-bottom: 20px;
        /* Adjust the value as needed */
    }
    </style>
</head>

<body>

    <?php
   include 'header.php';
    
  
    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
   
   
    ?>




    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Category</h4>

                            <ul>
                                <?php foreach ($categories as $category): ?>
                                <li><a
                                        href="category_product.php?category=<?php echo urlencode($category['catid']); ?>"><?php echo $category['categoryname']; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">

                        </div>

                        <div class="sidebar__item">
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-7">

                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select onchange="location = this.value;">
                                        |

                                        <option value="product_List.php?sort=asc"
                                            <?php if ($sortOrder == 'asc') echo 'selected'; ?>>Low to High</option>
                                        <option value="product_List.php?sort=desc"
                                            <?php if ($sortOrder == 'desc') echo 'selected'; ?>>High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <?php
                                    
                                    $sqlCount = "SELECT COUNT(*) AS total FROM products";
                                    $resultCount = mysqli_query($connect, $sqlCount);
                                    $rowCount = mysqli_fetch_assoc($resultCount)['total'];
                                    ?>
                                    <h6><span>
                                            <?php echo $rowCount ?>
                                        </span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">



                        <?php

                        // session_start();
                        $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';


                        $limit = 6; // Number of products per page
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($currentPage - 1) * $limit;

                        $sqlProducts = "SELECT * FROM products ORDER BY price $sortOrder LIMIT $offset, $limit ";
                        $resultProducts = mysqli_query($connect, $sqlProducts);

                        while ($product = $resultProducts->fetch_assoc()) {
                            $productId = $product['pid'];
                            $sqlImages = "SELECT image FROM products_image WHERE pid = $productId AND prt = 1";
                            $resultImages = mysqli_query($connect, $sqlImages);


                            while ($image = $resultImages->fetch_assoc()) {
                                echo '<div class="col-lg-4 col-md-6 col-sm-6 ">';
                                echo '<div class="shadow product__item rounded">';
                                echo '<div class="product__item__pic set-bg rounded" data-setbg="product_images/' . $image['image'] . '">';
                            }
                            echo '<ul class="product__item__pic__hover">';
                            echo ' <li><a href=""><i class="fa fa-heart"></i></a></li>';
                            echo ' <li><a href="product_details.php?&product_id=' . $product['pid'] . '"><i class="fa fa-retweet"></i></a></li>';
                            echo ' <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>';
                            echo '   </ul>';
                            echo '</div>';
                            echo ' <div class="product__item__text">';


                            echo '<h6><a href="product_details.php?&product_id=' . $product['pid'] . '">' . $product['name'] . '</a></h6>';

                            echo '<h5> Rs.' .number_format($product['price'],2)  . '</h5>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            
                        }
                        ?>

                    </div>

                    <div class="product__pagination">


                        <?php
                        $totalPages = ceil($rowCount / $limit);

                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = ($i == $currentPage) ? "active" : "";
                            echo '<a class="' . $activeClass . '" href="?page=' . $i . '&sort=' . $sortOrder . '">' . $i . '</a>';
                        }
                        ?>

                    </div>
                    <!-- //pagination system  start  -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <?php

    include 'footer.php';
    ?>


</body>

</html>