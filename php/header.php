<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<!-- Css Styles -->
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="css/nice-select.css" type="text/css">
<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <?php session_start();
    ?>



    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <?php
    include 'connect.php';


    ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
    .link-secondary,
    .link-secondary:hover {
        color: #89ac4b;

        text-decoration: none;

    }

    .humberger__open {
        position: fixed;
        top: 20px;
        /* Adjust the top distance according to your design */
        left: 20px;
        /* Adjust the right distance according to your design */
        z-index: 1001;
        /* Ensure a higher z-index to appear above the fixed header */
        cursor: pointer;
        /* Add a pointer cursor for better usability */
        background-color: #ffffffba;
    }

    @media only screen and (max-width: 767px) {
        .hero__categories {
            display: none !important;
        }
    }
    </style>
    <div id="google_translate_element">

        <!-- Humberger Begin -->
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <a href="index.php"><img src="img/newlogo3.png" alt=""></a>
            </div>
            <div class="humberger__menu__cart">
                <ul>
                    <?php
                    if (isset($_SESSION['u']['userid'])) {
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
                        function getCartProducts($cartId)
                        {
                            global $connect;

                            $cartProductsQuery = "SELECT * FROM cart_product WHERE cartid = $cartId";
                            $cartProductsResult = $connect->query($cartProductsQuery);

                            $cartProducts = [];
                            while ($row = $cartProductsResult->fetch_assoc()) {
                                $cartProducts[] = $row;
                            }

                            return $cartProducts;
                        }

                        $userid = $_SESSION['u']['userid'];

                        $cartId = checkOrCreateCart();
                        $cartcountQuery = "SELECT COUNT(cartpdtid) AS cart_count FROM cart_product WHERE cartid = $cartId";
                        $cartResult = $connect->query($cartcountQuery);

                        if ($cartResult) {
                            $cartCount = $cartResult->fetch_assoc()['cart_count'];
                            echo '<li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>' . $cartCount . '</span></a></li>';
                        } else {
                            echo '<li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>';
                        }

                        $wishlistcountQuery = "SELECT COUNT(pid) AS wishlist_count FROM wishlist WHERE userid = $userid";
                        $wishlistResult = $connect->query($wishlistcountQuery);

                        if ($wishlistResult) {
                            $wishlistCount = $wishlistResult->fetch_assoc()['wishlist_count'];
                            echo '<li><a href="wishlist.php"><i class="fa fa-heart"></i> <span>' . $wishlistCount . '</span></a></li>';
                        } else {
                            echo '<li><a href="wishlist.php"><i class="fa fa-heart"></i> <span>0</span></a></li>';
                        }


                    } else {
                        echo ' <li><a href="login.php"><i class="fa fa-heart"></i> <span>0</span></a></li>';
                        echo '<li><a href="login.php"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>';
                    }
                    ?>
                </ul>

                <?php
                if (isset($_SESSION['u']['userid'])) {

                    // Calculate and display total price
                    $cartProducts = getCartProducts($cartId);
                    $totalPrice = calculateNetPrice($cartProducts);
                    echo '<div class="header__cart__price">item: <span>Rs ' . number_format($totalPrice, 2) . '</span></div>';
                } else {
                    echo '<div class="header__cart__price">item: <span>Rs 0.00</span></div>';
                }

                ?>
            </div>
            <div class="humberger__menu__widget">
                <div class="header__top__right__language">

                </div>

                <div class="header__top__right__auth">
                    <?php

                    if (isset($_SESSION['u']['userid'])) {
                        echo '<a href="userprofile.php"><b>Welcome, ' . $_SESSION['u']['username'] . '</b></a>';

                    } else {
                        echo '<a href="login.php"><i class="fa fa-user"></i> Login</a>';
                    }
                    ?>
                </div>
            </div>
            <nav class="humberger__menu__nav mobile-menu">
                <ul>
                    <li class="active"><a href="./index.php">Home</a></li>
                    <li><a href="./product_List.php">Shop</a></li>

                    <?php
                    if (isset($_SESSION['u']['userid'])) {
                        echo '
                                        <li><a href="userprofile.php">My Profile</a>
                                        <ul class="header__menu__dropdown">
                                            
                                            <li><a href="./my_orders.php">My Orders</a></li>
                                            <li><a href="./address.php">Address</a></li>
                                            <li><a href="./logout">Logout</a></li>
                                        </ul>
                                    </li>';
                    } else {
                        echo '<li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>';
                    }
                    ?>

                    <li><a href="./blog.html">Contact us</a></li>

                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
            <div class="header__top__right__social">
                <a href="https://www.facebook.com/people/Saradha-Lanka-Agro-Company/61554719785903/"><i
                        class="fa fa-facebook"></i></a>
                <a href="https://wa.me/940771977766"><i class="fa fa-whatsapp"></i></a>

            </div>
            <div class="humberger__menu__contact">
                <ul>
                    <li><i class="fa fa-envelope"></i>saradhalankagaro@gmail.com</li>

                </ul>
            </div>
        </div>
        <!-- Humberger End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header__top__left">
                                <ul>
                                    <li><i class="fa fa-envelope"></i>saradhalankaagro@gmail.com</li>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a
                                        href="https://www.facebook.com/people/Saradha-Lanka-Agro-Company/61554719785903/"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="https://wa.me/940771977766"><i class="fa fa-whatsapp"></i></a>

                                </div>

                                <div class="header__top__right__auth">
                                    <?php
                                    if (isset($_SESSION['u']['userid'])) {
                                        echo '<a href="userprofile.php">Welcome, ' . $_SESSION['u']['username'] . '</a>';
                                    } else {
                                        echo '<a href="login.php"><i class="fa fa-user"></i> Login</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="./index.php"><img src="img/newlogo3.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'class="active"' : ''; ?>>
                                    <a href="./index.php">Home</a>
                                <li
                                    <?php echo ($_SERVER['PHP_SELF'] == '/product_List.php') ? 'class="active"' : ''; ?>>
                                    <a href="product_List.php">Shop</a>
                                </li>

                                <?php
                                if (isset($_SESSION['u']['userid'])) {
                                    echo '
                    <li class="'; // Start the class attribute for My Profile
                                
                                    // Check if the current page is any of the user profile-related pages
                                    $isUserProfilePage = in_array(
                                        basename($_SERVER['PHP_SELF']),
                                        array('userprofile.php', 'my_orders.php', 'Addresses.php')
                                    );

                                    echo ($isUserProfilePage) ? 'active' : ''; // Add 'active' class if true
                                
                                    echo '">
                        <a href="userprofile.php">My Profile</a>
                        <ul class="header__menu__dropdown">
                            <li><a href="./my_orders.php">My Orders</a></li>
                            <li><a href="./Addresses.php">Address</a></li>
                            <li><a href="./logout">Logout</a></li>
                        </ul>
                    </li>';
                                } else {
                                    echo '<li><a href="login.php"> Login</a></li>';
                                }
                                ?>

                                <li <?php echo ($_SERVER['PHP_SELF'] == '/contact.php') ? 'class="active"' : ''; ?>>
                                    <a href="./contact.php">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <ul>
                                <?php
                                if (isset($_SESSION['u']['userid'])) {




                                    $userid = $_SESSION['u']['userid'];

                                    $cartId = checkOrCreateCart();
                                    $cartcountQuery = "SELECT COUNT(cartpdtid) AS cart_count FROM cart_product WHERE cartid = $cartId";
                                    $cartResult = $connect->query($cartcountQuery);

                                    if ($cartResult) {
                                        $cartCount = $cartResult->fetch_assoc()['cart_count'];
                                        echo '<li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>' . $cartCount . '</span></a></li>';
                                    } else {
                                        echo '<li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>';
                                    }

                                    $wishlistcountQuery = "SELECT COUNT(pid) AS wishlist_count FROM wishlist WHERE userid = $userid";
                                    $wishlistResult = $connect->query($wishlistcountQuery);

                                    if ($wishlistResult) {
                                        $wishlistCount = $wishlistResult->fetch_assoc()['wishlist_count'];
                                        echo '<li><a href="wishlist.php"><i class="fa fa-heart"></i> <span>' . $wishlistCount . '</span></a></li>';
                                    } else {
                                        echo '<li><a href="wishlist.php"><i class="fa fa-heart"></i> <span>0</span></a></li>';
                                    }


                                } else {
                                    echo ' <li><a href="login.php"><i class="fa fa-heart"></i> <span>0</span></a></li>';
                                    echo '<li><a href="login.php"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>';
                                }
                                ?>

                            </ul>

                            <?php
                            if (isset($_SESSION['u']['userid'])) {

                                // Calculate and display total price
                                $cartProducts = getCartProducts($cartId);
                                $totalPrice = calculateNetPrice($cartProducts);
                                echo '<div class="header__cart__price">item: <span>Rs ' . number_format($totalPrice, 2) . '</span></div>';
                            } else {
                                echo '<div class="header__cart__price">item: <span>Rs 0.00</span></div>';
                            }

                            ?>

                        </div>
                    </div>
                </div>
                <div class="humberger__open rounded shadow">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Hero Section Begin -->
        <section class="hero hero-normal">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="hero__categories rounded">
                            <div class="shadow hero__categories__all rounded">
                                <i class="fa fa-bars"></i>
                                <span>All catagory</span>
                            </div>
                            <?php

                            $categorysql = "SELECT * FROM category";
                            $categoryresult = mysqli_query($connect, $categorysql);
                            $categories = [];
                            while ($row = $categoryresult->fetch_assoc()) {
                                $categories[] = $row;
                            }
                            ?>

                            <ul>
                                <?php foreach ($categories as $category): ?>
                                <li><a
                                        href="category_product.php?category=<?php echo urlencode($category['catid']); ?>">
                                        <?php echo $category['categoryname']; ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>
                    <div class=" col-lg-9">
                        <div class="hero__search">
                            <div class="hero__search__form rounded-left">
                                <form action="search.php" method="get">

                                    <input type="text" name="search" class="rounded-left"
                                        placeholder="What do you need?">
                                    <button type="submit" class="site-btn rounded-right">SEARCH</button>
                                </form>
                                <div class="hero__search__phone">
                                    <div class="hero__search__phone__icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </section>

</body>