<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateStatus(orderId, currentStatus) {
            let newStatus;
            switch (currentStatus) {
                case 'Pending':
                    newStatus = 'Awaiting payment';
                    break;
                case 'Awaiting payment':
                    newStatus = 'Processing';
                    break;
                case 'Processing':
                    newStatus = 'Shipping';
                    break;
                case 'Shipping':
                    newStatus = 'Delivered';
                    break;
                default:
                    newStatus = 'Pending';
            }

            $.ajax({
                url: 'update_order_status.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    orderid: orderId,
                    status: newStatus
                },
                success: function (response) {
                    if (response.success) {
                        alert('successed to update status: ');
                        location.reload();
                    } else {
                        alert('Failed to update status: ' + response.error);
                    }
                },
                error: function (xhr, status, error) {
                    alert('AJAX error: ' + error);
                }
            });
        }

        function deleteOrder(orderId) {
            if (confirm('Are you sure you want to delete this order?')) {
                $.ajax({
                    url: 'delete_order.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        orderid: orderId
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Order deleted successfully.');
                            location.reload();
                        } else {
                            alert('Failed to delete order: ' + response.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('AJAX error: ' + error);
                    }
                });
            }
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-bold mb-0">New Orders</h4>
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
                                        $query = "SELECT * FROM orders WHERE status NOT IN ('Delivered','Cancelled') ORDER BY date DESC";
                                        $result = $connect->query($query);

                                        if ($result && $result->num_rows > 0) {
                                            $statusColors = array(
                                                'new' => 'text-primary',
                                                'Pending' => 'text-primary',
                                                'Awaiting payment' => 'text-warning',
                                                'Processing' => 'text-info',
                                                'Shipping' => 'text-success',
                                                'Delivered' => 'text-danger'
                                            );
                                            while ($row = $result->fetch_assoc()): ?>
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
                                                    <td>Rs.<?php echo $row['tprice']; ?>.00</td>
                                                    <td><?php echo date('Y-m-d', strtotime($row['date'])); ?></td>

                                                    <td id="status-<?php echo $row['orderid']; ?>"
                                                        class="<?php echo $statusColors[$row['status']]; ?>">
                                                        <?php echo $row['status']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="orderdetails.php?order_id=<?php echo $row['orderid']; ?>"
                                                            class="btn btn-inverse-primary btn-fw">View Details</a>
                                                        <button
                                                            onclick="updateStatus(<?php echo $row['orderid']; ?>, '<?php echo $row['status']; ?>')"
                                                            class="btn btn-inverse-success btn-fw">Update Status</button>
                                                        <button onclick="deleteOrder(<?php echo $row['orderid']; ?>)"
                                                            class="btn btn-inverse-danger btn-fw">Delete</button>

                                                    </td>
                                                </tr>
                                            <?php endwhile;

                                        } else {
                                            echo "<tr><td colspan='7'>No orders found.</td></tr>";
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