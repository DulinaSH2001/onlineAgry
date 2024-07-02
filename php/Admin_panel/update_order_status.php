<?php
include 'connect.php';

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderId = $_POST['orderid'];
    $status = $_POST['status'];

    $query = "UPDATE orders SET status = ? WHERE orderid = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('si', $status, $orderId);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = $stmt->error;
    }

    $stmt->close();
}

$connect->close();
header('Content-Type: application/json');
echo json_encode($response);
?>