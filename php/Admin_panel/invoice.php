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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Order Invoice</title>
    <style type="text/css">
    body {
        margin-top: 20px;
        background: #eee;
    }

    .invoice {
        background: #fff;
        padding: 20px
    }

    .invoice-company {
        font-size: 20px
    }

    .invoice-header {
        margin: 0 -20px;
        background: #f0f3f4;
        padding: 20px
    }

    .invoice-date,
    .invoice-from,
    .invoice-to {
        display: table-cell;
        width: 1%
    }

    .invoice-from,
    .invoice-to {
        padding-right: 20px
    }

    .invoice-date .date,
    .invoice-from strong,
    .invoice-to strong {
        font-size: 16px;
        font-weight: 600
    }

    .invoice-date {
        text-align: right;
        padding-left: 20px
    }

    .invoice-price {
        background: #f0f3f4;
        display: table;
        width: 100%
    }

    .invoice-price .invoice-price-left,
    .invoice-price .invoice-price-right {
        display: table-cell;
        padding: 20px;
        font-size: 20px;
        font-weight: 600;
        width: 75%;
        position: relative;
        vertical-align: middle
    }

    .invoice-price .invoice-price-left .sub-price {
        display: table-cell;
        vertical-align: middle;
        padding: 0 20px
    }

    .invoice-price small {
        font-size: 12px;
        font-weight: 400;
        display: block
    }

    .invoice-price .invoice-price-row {
        display: table;
        float: left
    }

    .invoice-price .invoice-price-right {
        width: 25%;
        background: #2d353c;
        color: #fff;
        font-size: 28px;
        text-align: right;
        vertical-align: bottom;
        font-weight: 300
    }

    .invoice-price .invoice-price-right small {
        display: block;
        opacity: .6;
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 12px
    }

    .invoice-footer {
        border-top: 1px solid #ddd;
        padding-top: 10px;
        font-size: 10px
    }

    .invoice-note {
        color: #999;
        margin-top: 80px;
        font-size: 85%
    }

    .invoice>div:not(.invoice-footer) {
        margin-bottom: 20px
    }

    .btn.btn-white,
    .btn.btn-white.disabled,
    .btn.btn-white.disabled:focus,
    .btn.btn-white.disabled:hover,
    .btn.btn-white[disabled],
    .btn.btn-white[disabled]:focus,
    .btn.btn-white[disabled]:hover {
        color: #2d353c;
        background: #fff;
        border-color: #d9dfe3;
    }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="col-md-12">
            <div class="invoice">
                <!-- begin invoice-company -->
                <div class="invoice-company text-inverse f-w-600">
                    <span class="pull-right hidden-print">

                        <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i
                                class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                    </span>
                    <img src="../img/newlogo3.png" width="300" height="100"><br>
                </div>
                <!-- end invoice-company -->
                <!-- begin invoice-header -->
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>from</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse"> 538/D </strong><br>
                            Kandy road,<br> Mahena,<br>Warakapola,<br> Warakapola,<br> Sri Lanka
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>to</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">
                                <?= $customer['fname'] ?>
                                <?= $customer['lname'] ?>
                            </strong><br>
                            <?= $address['street_address'] ?>,<br />
                            <?= $address['town'] ?>,<br />
                            <?= $address['Postcode'] ?><br />
                            Phone:
                            <?= $customer['phone'] ?>

                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>invoice</small>
                        <div class="date text-inverse m-t-5">
                            <?php
                            $currentDate = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS
                            echo " $currentDate";
                            ?>
                        </div>
                        <div class="invoice-detail">
                            #0000
                            <?= $orderId ?><br>

                        </div>
                    </div>
                </div>
                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                    <!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Cart Product</th>
                                    <th class="text-center" width="10%">Name</th>
                                    <th class="text-center" width="10%">Qty</th>
                                    <th class="text-center" width="10%">Unit Price</th>
                                    <th class="text-right" width="20%">Total price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cartProducts as $cartProduct) {
                                    echo '<tr>';
                                    echo '<td><span class="text-inverse">' . $cartProduct['name'] . '</span></td>';
                                    echo '<td class="text-center">' . $cartProduct['qty'] . '</td>';
                                    echo '<td class="text-center">Rs ' . number_format($cartProduct['p_price'], 2) . '</td>';
                                    echo '<td class="text-center">Rs ' . number_format($cartProduct['qty'] * $cartProduct['p_price'], 2) . '</td>';
                                    echo '</tr>';
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                    <!-- begin invoice-price -->
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">

                                </div>
                                <div class="sub-price">

                                </div>
                                <div class="sub-price">

                                </div>
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>TOTAL</small> <span class="f-w-600">Rs
                                <?= number_format($order['tprice'], 2) ?>
                            </span>
                        </div>
                    </div>
                    <!-- end invoice-price -->
                </div>
                <!-- end invoice-content -->
                <!-- begin invoice-note -->
                <div class="invoice-note">
                    * Make all cheques payable to [Your Company Name]<br>
                    * Payment is due within 30 days<br>
                    * If you have any questions concerning this invoice, contact [Name, Phone Number, Email]
                </div>
                <!-- end invoice-note -->
                <!-- begin invoice-footer -->
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> saradhalanakaagro.com</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:0352282049</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:0718318313</span>
                        <span class="m-r-10"><i
                                class="fa fa-fw fa-lg fa-envelope"></i>saradhalanakaagro@gmail.com</span>
                    </p>
                </div>
                <!-- end invoice-footer -->
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>