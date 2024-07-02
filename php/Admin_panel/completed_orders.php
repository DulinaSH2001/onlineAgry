<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">Completed Orders</h4>
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
                                            <th>Customer Name</th>
                                            <th>Total Price</th>
                                            <th>Order Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
include 'connect.php'; 

$query = "SELECT * FROM orders WHERE status = 'Delivered' ORDER BY date DESC";
$result = $connect->query($query);

if ($result && $result->num_rows > 0) {
?>

                                        <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['orderid']; ?></td>
                                            <td>
                                                <?php
                                                $userId = $row['userid'];
                                                $userQuery = "SELECT fname, lname FROM users WHERE userid = '$userId'";
                                                $userResult = $connect->query($userQuery);
                                                if ($userResult && $userResult->num_rows > 0) {
                                                    $userRow = $userResult->fetch_assoc();
                                                    echo $userRow['fname'] . ' ' . $userRow['lname'];
                                                } else {
                                                    echo "Unknown User";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $row['tprice']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td id="status-<?php echo $row['orderid']; ?>"><?php echo $row['status']; ?>
                                            </td>
                                            <td>
                                                <a href="orderdetails.php?order_id=<?php echo $row['orderid']; ?>"
                                                    class="btn btn-inverse-primary btn-fw">View Details</a>
                                                <button onclick="deleteOrder(<?php echo $row['orderid']; ?>)"
                                                    class="btn btn-inverse-danger btn-fw">Delete</button>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>

                                        <?php
} else {
    echo "No completed orders found.";
}

$connect->close();
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>

        </div>
    </div>
</body>

</html>