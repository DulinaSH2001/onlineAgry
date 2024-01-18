<!-- ordermanagement.php -->

<?php
include 'connect.php'; // Include your database connection file

// Fetch orders from the database, excluding completed or canceled orders
$query = "SELECT * FROM orders WHERE status NOT IN ('complete', 'cancel') ORDER BY date DESC";

$result = $connect->query($query);

// Check if there are any orders
if ($result->num_rows > 0) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">New Orders </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="productTable">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Orders</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">


                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer ID</th>

                                            <th>Total Price</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['orderid']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['userid']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['tprice']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['status']; ?>
                                            </td>
                                            <td>
                                                <a href="orderdetails.php?order_id=<?php echo $row['orderid']; ?>"
                                                    class="btn btn-inverse-primary btn-fw">View
                                                    Details</a>

                                                <a href="#" onclick="updateStatus(<?php echo $row['orderid']; ?>)"
                                                    class="btn btn-inverse-success btn-fw">Update
                                                    Status</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php include 'footer.php'; ?>

</body>

</html>

<?php
} else {
    echo "No orders found.";
}

// Close the database connection
$connect->close();
?>