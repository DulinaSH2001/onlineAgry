<?php
include 'connect.php'; // Include your database connection file

// Assuming you pass the order_id through the URL, e.g., orderdetails.php?order_id=123
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Fetch order details
    $orderQuery = "SELECT * FROM orders WHERE orderid = $orderId";
    $orderResult = $connect->query($orderQuery);

    if ($orderResult->num_rows > 0) {
        $order = $orderResult->fetch_assoc();

        $customerId = $order['userid'];
        $customerQuery = "SELECT * FROM users WHERE userid = $customerId";
        $customerResult = $connect->query($customerQuery);
        $customer = $customerResult->fetch_assoc();


        $addressId = $order['addressid'];
        $addressQuery = "SELECT * FROM address WHERE addressid = $addressId";
        $addressResult = $connect->query($addressQuery);
        $address = $addressResult->fetch_assoc();


        $cartId = $order['cartid'];
        $cartQuery = "SELECT cp.*, p.name, p.price FROM cart_product cp
                      JOIN products p ON cp.productid = p.pid
                      WHERE cp.cartid = $cartId";
        $cartResult = $connect->query($cartQuery);

        if ($cartResult) {
            $cartProducts = $cartResult->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Error executing query: " . $connect->error;
        }
    } else {
        echo "Order not found.";
        exit;
    }
} else {
    echo "Invalid request. Order ID is missing.";
    exit;
}
?>

<!-- ... Previous PHP code ... -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Order Details</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container-fluid">
                <h2>Order Details</h2>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Display order information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Order Information</h5>

                                <p><strong>Order ID:</strong>
                                    <?= $orderId ?>
                                </p>
                                <p><strong>Order Date:</strong>
                                    <?= $order['date'] ?>
                                </p>
                                <p><strong>Status:</strong>
                                    <?= $order['status'] ?>
                                </p>
                            </div>
                        </div>

                        <!-- Display customer information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Customer Information</h5>
                                <p><strong>Customer ID:</strong>
                                    <?= $customerId ?>
                                </p>
                                <p><strong>Customer Name:</strong>
                                    <?= $customer['fname'] ?>
                                    <?= $customer['lname'] ?>
                                </p>
                                <p><strong>Email:</strong>
                                    <?= $customer['email'] ?>
                                </p>
                                <p><strong>phone number:</strong>
                                    <?= $customer['phone'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Display billing information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Billing Information</h5>
                                <p><strong>Total Price:</strong> Rs
                                    <?= number_format($order['tprice'], 2) ?>
                                </p>
                                <p><strong>Address ID:</strong>
                                    <?= $addressId ?>
                                </p>
                                <p><strong>Address:</strong><br />
                                    <?= $address['street_address'] ?>,<br />
                                    <?= $address['town'] ?>,<br />
                                    <?= $address['Postcode'] ?><br />
                                </p>
                            </div>
                        </div>

                        <!-- Display product list -->
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Product List</h5>
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
                                                echo '<td>Rs ' . number_format($cartProduct['p_price'], 2) . '</td>';
                                                echo '<td>Rs ' . number_format($cartProduct['qty'] * $cartProduct['p_price'], 2) . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Print Invoice button -->
                <div class="text-right mt-3">
                    <a href="invoice.php?order_id=<?= $orderId; ?>" class="btn btn-inverse-primary btn-icon-text">
                        <i class="ti-printer btn-icon-append"></i> Print Invoice
                    </a>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>


        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        </script>
</body>

</html>