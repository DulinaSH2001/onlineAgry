<!DOCTYPE html>
< lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>RoyalUI Admin</title>
    </head>

    <body>
        <?php include 'header.php'; ?>
        <?php

        // Query to get the number of orders
        $orderQuery = "SELECT COUNT(*) AS orderCount FROM orders WHERE date >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        $orderResult = $connect->query($orderQuery);
        $orderRow = $orderResult->fetch_assoc();
        $numberOfOrders = $orderRow['orderCount'];

        // Query to get the number of users
        $userQuery = "SELECT COUNT(*) AS userCount FROM users";
        $userResult = $connect->query($userQuery);
        $userRow = $userResult->fetch_assoc();
        $numberOfUsers = $userRow['userCount'];

        // Query to get the number of products
        $productQuery = "SELECT COUNT(*) AS productCount FROM products";
        $productResult = $connect->query($productQuery);
        $productRow = $productResult->fetch_assoc();
        $numberOfProducts = $productRow['productCount'];

        // Query to get the total sales in the last 30 days
        $sellsQuery = "SELECT SUM(tprice) AS totalSales FROM orders WHERE date >= NOW() - INTERVAL 30 DAY";
        $sellsResult = $connect->query($sellsQuery);
        $sellsRow = $sellsResult->fetch_assoc();
        $totalSales = $sellsRow['totalSales'];
        ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="font-weight-bold mb-0">RoyalUI Dashboard</h4>
                            </div>
                            <div><a href="addproduct.php">
                                    <button type="button" class="btn btn-primary btn-icon-text text-white ">
                                        <i class="ti-clipboard btn-icon-prepend"></i>add
                                        product
                                    </button></a>
                                <a href="New_oredrs.php">
                                    <button type="button" class="btn btn-success btn-icon-text text-white">
                                        <i class="ti-clipboard btn-icon-prepend"></i>New Orders
                                    </button></a>
                                <a href="producttable.php">
                                    <button type="button" class="btn btn-warning  btn-icon-text text-white">
                                        <i class="ti-clipboard btn-icon-prepend"></i>All Products
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card ">
                            <div class="card-body">
                                <p class="card-title text-md-center text-xl-left">numbers of orders</p>
                                <div
                                    class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                                        <?= $numberOfOrders; ?>
                                    </h3>
                                    <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                </div>
                                <p class="mb-0 mt-2 text-danger"><span class="text-black ms-1"><small>(30
                                            days)</small></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title text-md-center text-xl-left">All Users </p>
                                <div
                                    class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                                        <?= $numberOfUsers; ?>
                                    </h3>
                                    <!-- read the users table an get number off users count  -->
                                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                </div>
                                <p class="mb-0 mt-2 text-danger"><span class="text-black ms-1"><small></small></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title text-md-center text-xl-left">products</p>
                                <div
                                    class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                                        <?= $numberOfProducts; ?>
                                    </h3>
                                    <!-- read the products page and show all products count -->
                                    <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                </div>
                                <p class="mb-0 mt-2 text-success"><span class="text-black ms-1"><small></small></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title text-md-center text-xl-left">Sells</p>
                                <div
                                    class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">
                                        <?= $totalSales; ?>
                                    </h3>
                                    <!-- read the order table and get last 30 sells using sum of tprice column  -->
                                    <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                                </div>
                                <p class="mb-0 mt-2 text-success"><span class="text-black ms-1"><small>(30
                                            days)</small></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <?php include 'footer.php'; ?>

            <!-- main-panel ends -->
    </body>

    </html>