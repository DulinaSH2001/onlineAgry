<?php
include 'connect.php'; // Your database connection

$response = array('success' => false, 'error' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['orderid'];

    if ($orderId) {
        $query = "DELETE FROM orders WHERE orderid = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param('i', $orderId);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Failed to delete order.';
        }

        $stmt->close();
    } else {
        $response['error'] = 'Invalid order ID.';
    }
} else {
    $response['error'] = 'Invalid request method.';
}

echo json_encode($response);
$connect->close();
?>