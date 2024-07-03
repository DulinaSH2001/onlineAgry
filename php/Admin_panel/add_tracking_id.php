<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['orderid'];
    $trackingId = $_POST['tracking_id'];
    $company_name = $_POST['company_name'];
    

    if (!empty($orderId) && !empty($trackingId)) {
        $query = "UPDATE orders SET tracking_id = ?, company_name = ? WHERE orderid = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssi", $trackingId, $company_name, $orderId);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    }

    $connect->close();
    exit();
} else {
    if (isset($_GET['order_id'])) {
        $orderId = $_GET['order_id'];
        
        $query = "SELECT tracking_id FROM orders WHERE orderid = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $stmt->bind_result($trackingId);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "No order ID provided.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tracking ID</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                            <h4 class="card-title">Add Tracking ID</h4>
                            <form id="trackingForm" method="POST">
                                <div class="form-group">
                                    <label for="tracking_id">Delivery Company</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        value="<?php echo $trackingId; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tracking_id">Tracking ID</label>
                                    <input type="text" class="form-control" id="tracking_id" name="tracking_id"
                                        value="<?php echo $trackingId; ?>" required>
                                </div>
                                <input type="hidden" name="orderid" value="<?php echo $orderId; ?>">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="order_management.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#trackingForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: 'add_tracking_id.php',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert('Tracking ID added successfully.');
                        window.location.href = 'tracking_manage.php';
                    } else {
                        alert('Failed to add tracking ID: ' + response
                            .error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('AJAX error: ' + error);
                }
            });
        });
    });
    </script>
</body>

</html>