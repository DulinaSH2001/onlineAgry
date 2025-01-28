<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        /* Your custom styles go here */


        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            display: flex;
            height: 100%;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            display: flex;
            height: 100%;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        /* Responsive styles */
        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
            }

            .content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }

        /* Additional modifications for smaller screens */
        @media screen and (max-width: 320px) {
            .sidebar {
                padding: 10px;
            }

            .content {
                padding: 10px;
            }
        }

        /* Additional modifications for larger screens */
        @media screen and (min-width: 1200px) {
            .sidebar {
                width: 300px;
            }
        }

        body {
            background: #eee;
        }

        .order-card {
            display: flex;
            justify-content: space-between;
            /* Align items to the start and end of the container */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 7px;
            background-color: white;
            max-width: 600px;
            max-height: 600px;

        }

        .order-details {
            flex: 1;
        }


        .order-actions {
            margin-left: 10px;
            /* Add some space between details and view button */
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="wrapper">
                        <nav class="sidebar">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                            </button>

                            <div class="collapse" id="sidebarCollapse">
                                <div class="list-group">
                                    <a href="userprofile.php" class="list-group-item list-group-item-action">My
                                        profile</a>
                                    <a href="my_orders.php" class="list-group-item list-group-item-action">My Orders</a>
                                    <a href="addresses.php" class="list-group-item list-group-item-action">Addresses</a>
                                    <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                                </div>
                            </div>
                        </nav>


                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="profile-form">
                        <div class="container bootdey">
                            <h2 class="mt-4 mb-4">My Orders</h2>

                            <?php
                            $userid = $_SESSION['u']['userid'];
                            $sql = "SELECT cartid, orderid, tprice, addressid, date FROM orders WHERE userid = $userid ORDER BY date DESC";
                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $cartId = $row["cartid"];
                                    $orderId = $row["orderid"];
                                    $totalPrice = $row["tprice"];
                                    $addressId = $row["addressid"];
                                    $date = $row["date"];

                                    // Fetch products from cart for the given order
                                    $cartQuery = "SELECT cp.*, p.name, p.price FROM cart_product cp
                                JOIN products p ON cp.productid = p.pid
                                WHERE cp.cartid = $cartId";
                                    $cartResult = $connect->query($cartQuery);

                                    // Check for query execution success
                                    if (!$cartResult) {
                                        echo "Error executing query: " . $connect->error;
                                    } else {
                                        $cartProducts = $cartResult->fetch_all(MYSQLI_ASSOC);
                                        // ... rest of the code ...
                            
                                        ?>



                                        <div class="card order-card">
                                            <div class="order-details">
                                                <h5 class="text"><strong><b>#00000
                                                            <?= $orderId ?>
                                                        </b>
                                                    </strong></h5>
                                                <p class="text">Cost: $
                                                    <?= $totalPrice ?>
                                                </p>
                                                <p class="text">Order made on:
                                                    <?= $date ?>
                                                </p>

                                                <p class="text text-right"><strong>Status:</strong> Checking Quality</p>
                                            </div>
                                            <div class="order-actions text-right">
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#orderDetailsModal<?= $orderId ?>">
                                                    View
                                                </button>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="orderDetailsModal<?= $orderId ?>" tabindex="-1" role="dialog"
                                            aria-labelledby="orderDetailsModalLabel<?= $orderId ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="orderDetailsModalLabel<?= $orderId ?>">Order
                                                            Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Order Information</h5>
                                                                        <p class="card-text"><strong>Order ID:</strong>
                                                                            <?= $orderId ?>
                                                                        </p>
                                                                        <p class="card-text"><strong>Order Date:</strong>
                                                                            <?= $date ?>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Billing Information</h5>
                                                                        <p class="card-text"><strong>Total Price:</strong> $
                                                                            <?= $totalPrice ?>
                                                                        </p>
                                                                        <p class="card-text"><strong>Address ID:</strong>
                                                                            <?= $addressId ?>
                                                                        </p>
                                                                        <?php
                                                                        // Fetch address from address table for the given address ID
                                                                        $addressQuery = "SELECT * FROM address WHERE addressid = $addressId";
                                                                        $addressResult = $connect->query($addressQuery);
                                                                        $address = $addressResult->fetch_assoc();
                                                                        ?>
                                                                        <p class="card-text"><strong>Address:</strong>
                                                                            <?= $address['street_address'] ?><br>
                                                                            <?= $address['town'] ?><br>
                                                                            <?= $address['Postcode'] ?>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Product List -->
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Unit Price</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($cartProducts as $cartProduct) {
                                                                        echo '<tr>';
                                                                        echo '<td>' . $cartProduct['name'] . '</td>';
                                                                        echo '<td>' . $cartProduct['qty'] . '</td>';
                                                                        echo '<td>$' . $cartProduct['p_price'] . '</td>';
                                                                        echo '<td>$' . $cartProduct['q_price'] . '</td>';
                                                                        echo '</tr>';
                                                                    }
                                    }
                                    ?>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                    <!-- Tracking Details -->
                                                    <div class="card mt-3">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Tracking Information</h5>
                                                            <div
                                                                class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                                                                <div class="w-100 text-center py-1 px-2"><span
                                                                        class="text-medium">Shipped
                                                                        Via:</span> UPS Ground</div>
                                                                <div class="w-100 text-center py-1 px-2"><span
                                                                        class="text-medium">Status:</span>
                                                                    Checking Quality</div>
                                                                <div class="w-100 text-center py-1 px-2"><span
                                                                        class="text-medium">Expected
                                                                        Date:</span> SEP 09, 2017</div>
                                                            </div>
                                                            <div
                                                                class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                }
                            } else {
                                echo "<p>No orders found.</p>";
                            }
                            ?>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>




    <?php include 'footer.php'; ?>



</body>

</html>